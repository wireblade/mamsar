<?php

namespace App\Livewire\Attendance;

use App\Models\AttendanceCutoff;
use App\Models\AttendanceRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class AttendanceRecordEditor extends Component
{
    use WithPagination;

    public string $cutoffId = '';

    public string $search = '';

    public function updatedCutoffId(): void
    {
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public array $editedTimes = [];

    public function editTimes(int $recordId): void
    {
        $record = AttendanceRecord::query()
            ->where('attendance_cutoff_id', $this->cutoffId)
            ->findOrFail($recordId);

        $this->editedTimes[$recordId] = [
            'clock_in_1' => $record->clock_in_1
                ? substr((string) $record->clock_in_1, 0, 5)
                : '',
            'clock_out_1' => $record->clock_out_1
                ? substr((string) $record->clock_out_1, 0, 5)
                : '',
            'clock_in_2' => $record->clock_in_2
                ? substr((string) $record->clock_in_2, 0, 5)
                : '',
            'clock_out_2' => $record->clock_out_2
                ? substr((string) $record->clock_out_2, 0, 5)
                : '',
        ];
    }

    public function saveTimes(int $recordId): void
    {
        if ($this->cutoffId === '') {
            $this->addError('save', 'Please select an attendance cutoff.');

            return;
        }

        $record = AttendanceRecord::query()
            ->where('attendance_cutoff_id', $this->cutoffId)
            ->findOrFail($recordId);

        if (! isset($this->editedTimes[$recordId])) {
            $this->addError('save', 'Please open the record for editing first.');

            return;
        }

        $this->resetValidation();

        $validator = Validator::make(
            $this->editedTimes[$recordId],
            [
                'clock_in_1' => ['nullable', 'date_format:H:i'],
                'clock_out_1' => ['nullable', 'date_format:H:i'],
                'clock_in_2' => ['nullable', 'date_format:H:i'],
                'clock_out_2' => ['nullable', 'date_format:H:i'],
            ]
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->addError('editedTimes.'.$recordId, $error);
            }

            return;
        }

        $times = $validator->validated();

        DB::transaction(function () use ($record, $times) {
            $date = Carbon::parse($record->attendance_date)->toDateString();

            $in1 = $this->parseEditedTime($times['clock_in_1'] ?? null, $date);
            $out1 = $this->parseEditedTime($times['clock_out_1'] ?? null, $date);
            $in2 = $this->parseEditedTime($times['clock_in_2'] ?? null, $date);
            $out2 = $this->parseEditedTime($times['clock_out_2'] ?? null, $date);

            $cutoff = AttendanceCutoff::findOrFail($this->cutoffId);

            $shift = $this->getShift(
                (string) $record->ac_no,
                $cutoff->company_code
            );

            // Determine whether the record uses four punches.
            $hasAfternoonPunch = $in2 !== null || $out2 !== null;

            if ($hasAfternoonPunch) {
                $morningIn = $in1;
                $morningOut = $out1;
                $afternoonIn = $in2;
                $afternoonOut = $out2;
            } else {
                // Two-punch attendance covers both work sessions.
                $morningIn = $in1;
                $morningOut = $out1;
                $afternoonIn = $in1;
                $afternoonOut = $out1;
            }

            // Apply the morning grace-period rule for worked minutes.
            $morningInForWork = $morningIn;

            if ($morningIn) {
                $shiftStart = Carbon::parse(
                    $date.' '.$shift['morning_start']
                );

                $graceEnd = $shiftStart->copy()
                    ->addMinutes($shift['morning_grace']);

                if (
                    $morningIn->greaterThan($shiftStart) &&
                    $morningIn->lessThanOrEqualTo($graceEnd)
                ) {
                    $morningInForWork = $shiftStart;
                }
            }

            // Recalculate worked minutes.
            $morningWorked = $this->minutesWorked(
                $morningInForWork,
                $morningOut,
                $shift['morning_start'],
                $shift['morning_end']
            );

            $afternoonWorked = $this->minutesWorked(
                $afternoonIn,
                $afternoonOut,
                $shift['afternoon_start'],
                $shift['afternoon_end']
            );

            $totalWorked = $morningWorked + $afternoonWorked;

            // Recalculate lateness.
            $morningLate = $this->calculateLateMinutes(
                $in1,
                $shift['morning_start'],
                $shift['morning_grace']
            );

            $afternoonLate = $hasAfternoonPunch
                ? $this->calculateLateMinutes(
                    $in2,
                    $shift['afternoon_start'],
                    $shift['afternoon_grace']
                )
                : 0;

            // Recalculate half-day and status.
            $hasAnyClock = $in1 !== null
                || $out1 !== null
                || $in2 !== null
                || $out2 !== null;

            $incomplete = ($in1 !== null && $out1 === null)
                || ($in1 === null && $out1 !== null)
                || ($in2 !== null && $out2 === null)
                || ($in2 === null && $out2 !== null);

            $sessionsWorked = (int) ($morningWorked > 0)
                + (int) ($afternoonWorked > 0);

            $isHalfDay = $sessionsWorked === 1;

            if (! $hasAnyClock) {
                $status = 'ABSENT';
                $isHalfDay = false;
            } elseif ($incomplete) {
                $status = 'INCOMPLETE';
            } elseif ($morningLate > 0) {
                $status = 'TARDY';
            } else {
                $status = 'PRESENT';
            }

            // Save the times and all recalculated values together.
            $record->update([
                'clock_in_1' => $in1?->format('H:i:s'),
                'clock_out_1' => $out1?->format('H:i:s'),
                'clock_in_2' => $in2?->format('H:i:s'),
                'clock_out_2' => $out2?->format('H:i:s'),

                'morning_worked' => $morningWorked,
                'afternoon_worked' => $afternoonWorked,
                'total_worked' => $totalWorked,

                'late_minutes_morning' => $morningLate,
                'late_minutes_afternoon' => $afternoonLate,
                'late_minutes' => $morningLate + $afternoonLate,

                'is_half_day' => $isHalfDay,
                'status' => $status,
            ]);
        });

        unset($this->editedTimes[$recordId]);

        session()->flash(
            'success',
            'Attendance times and calculations updated successfully.'
        );
    }

    private function parseEditedTime(
        mixed $value,
        string $date
    ): ?Carbon {
        if ($value === null || $value === '') {
            return null;
        }

        return Carbon::parse($date.' '.$value);
    }

    private function getShift(string $acNo, string $companyCode): array
    {
        $acNo = trim($acNo);

        // 4K Development Corporation schedule.
        if ($companyCode === '4KDC') {
            return [
                'morning_start' => '07:30',
                'morning_end' => '12:00',
                'afternoon_start' => '13:00',
                'afternoon_end' => '16:30',
                'morning_grace' => 5,
                'afternoon_grace' => 0,
            ];
        }

        // MCIC schedule exceptions.
        if (in_array($acNo, ['63', '50'], true)) {
            return [
                'morning_start' => '09:30',
                'morning_end' => '12:00',
                'afternoon_start' => '13:00',
                'afternoon_end' => '18:30',
                'morning_grace' => 5,
                'afternoon_grace' => 0,
            ];
        }

        if (in_array(
            $acNo,
            ['4', '17', '42', '43', '58', '112', '87', '90', '115'],
            true
        )) {
            return [
                'morning_start' => '07:30',
                'morning_end' => '12:00',
                'afternoon_start' => '13:00',
                'afternoon_end' => '16:30',
                'morning_grace' => 5,
                'afternoon_grace' => 0,
            ];
        }

        // Default MCIC schedule.
        return [
            'morning_start' => '08:00',
            'morning_end' => '12:00',
            'afternoon_start' => '13:00',
            'afternoon_end' => '17:00',
            'morning_grace' => 5,
            'afternoon_grace' => 0,
        ];
    }

    private function minutesWorked(
        ?Carbon $clockIn,
        ?Carbon $clockOut,
        string $windowStart,
        string $windowEnd
    ): int {
        if (
            ! $clockIn ||
            ! $clockOut ||
            $clockOut->lessThanOrEqualTo($clockIn)
        ) {
            return 0;
        }

        $date = $clockIn->toDateString();

        $shiftStart = Carbon::parse($date.' '.$windowStart);
        $shiftEnd = Carbon::parse($date.' '.$windowEnd);

        $actualStart = $clockIn->greaterThan($shiftStart)
            ? $clockIn->copy()
            : $shiftStart->copy();

        $actualEnd = $clockOut->lessThan($shiftEnd)
            ? $clockOut->copy()
            : $shiftEnd->copy();

        if ($actualEnd->lessThanOrEqualTo($actualStart)) {
            return 0;
        }

        return (int) $actualStart->diffInMinutes($actualEnd);
    }

    private function calculateLateMinutes(
        ?Carbon $clockIn,
        string $shiftStart,
        int $grace
    ): int {
        if (! $clockIn) {
            return 0;
        }

        $shiftStartTime = Carbon::parse(
            $clockIn->toDateString().' '.$shiftStart
        );

        $graceEnd = $shiftStartTime->copy()->addMinutes($grace);

        if ($clockIn->lessThanOrEqualTo($graceEnd)) {
            return 0;
        }

        return max(
            0,
            (int) $shiftStartTime->diffInMinutes($clockIn)
        );
    }

    public function render()
    {
        $cutoffs = AttendanceCutoff::query()
            ->orderByDesc('start_date')
            ->get();

        $records = collect();

        if ($this->cutoffId !== '') {
            $cutoff = AttendanceCutoff::find($this->cutoffId);

            if ($cutoff) {
                $search = trim($this->search);

                $records = $cutoff->records()
                    ->when($search !== '', function ($query) use ($search) {
                        $query->where(function ($query) use ($search) {
                            $query->whereRaw(
                                'CAST(ac_no AS TEXT) ILIKE ?',
                                ['%'.$search.'%']
                            )->orWhere('employee_name', 'ILIKE', '%'.$search.'%');
                        });
                    })
                    ->orderBy('employee_name')
                    ->orderBy('attendance_date')
                    ->paginate(50);
            }
        }

        return view('livewire.attendance.attendance-record-editor', [
            'cutoffs' => $cutoffs,
            'records' => $records,
        ])->layout('components.layouts.app');
    }
}
