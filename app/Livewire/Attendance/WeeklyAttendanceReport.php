<?php

namespace App\Livewire\Attendance;

use App\Exports\WeeklyAttendanceExport;
use App\Models\WeeklyAttendanceRecord;
use App\Models\WeeklyAttendanceWeek;
use Carbon\Carbon;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class WeeklyAttendanceReport extends Component
{
    use WithPagination;

    #[Url]
    public string $companyCode = 'MCIC';

    #[Url(as: 'week')]
    public ?int $selectedWeekId = null;

    public ?int $editingRecordId = null;

    public string $clockIn1 = '';

    public string $clockOut1 = '';

    public string $clockIn2 = '';

    public string $clockOut2 = '';

    public string $editingEmployeeName = '';

    public string $editingAcNo = '';

    public string $editingDate = '';

    public function updatedCompanyCode(): void
    {
        $this->selectedWeekId = null;
        $this->editingRecordId = null;
        $this->resetPage('recordsPage');
    }

    public function openWeek(int $weekId): void
    {
        $week = WeeklyAttendanceWeek::query()
            ->where('id', $weekId)
            ->where('company_code', $this->companyCode)
            ->firstOrFail();

        $this->selectedWeekId = $week->id;
        $this->resetPage('recordsPage');
    }

    public function backToWeeks(): void
    {
        $this->selectedWeekId = null;
        $this->editingRecordId = null;
        $this->resetPage('recordsPage');
    }

    public function editRecord(int $recordId): void
    {
        $record = WeeklyAttendanceRecord::query()
            ->where('id', $recordId)
            ->where('weekly_attendance_week_id', $this->selectedWeekId)
            ->firstOrFail();

        $this->editingRecordId = $record->id;

        $this->editingEmployeeName = $record->employee_name;
        $this->editingAcNo = (string) $record->ac_no;
        $this->editingDate = $record->attendance_date->format('M d, Y');

        $this->clockIn1 = $this->formatTime($record->clock_in_1);
        $this->clockOut1 = $this->formatTime($record->clock_out_1);
        $this->clockIn2 = $this->formatTime($record->clock_in_2);
        $this->clockOut2 = $this->formatTime($record->clock_out_2);
    }

    public function cancelEdit(): void
    {
        $this->reset([
            'editingRecordId',
            'clockIn1',
            'clockOut1',
            'clockIn2',
            'clockOut2',
            'editingEmployeeName',
            'editingAcNo',
            'editingDate',
        ]);

        $this->resetValidation();
    }

    public function saveRecord(): void
    {
        $this->validate([
            'clockIn1' => ['nullable', 'date_format:H:i'],
            'clockOut1' => ['nullable', 'date_format:H:i'],
            'clockIn2' => ['nullable', 'date_format:H:i'],
            'clockOut2' => ['nullable', 'date_format:H:i'],
        ]);

        $record = WeeklyAttendanceRecord::query()
            ->where('id', $this->editingRecordId)
            ->where('weekly_attendance_week_id', $this->selectedWeekId)
            ->firstOrFail();

        $record->clock_in_1 = $this->clockIn1 ?: null;
        $record->clock_out_1 = $this->clockOut1 ?: null;
        $record->clock_in_2 = $this->clockIn2 ?: null;
        $record->clock_out_2 = $this->clockOut2 ?: null;

        $record->save();

        $shift = $this->getShift(
            $record->ac_no,
            $record->week->company_code
        );

        $calculated = $this->calculateAttendance(
            $record->attendance_date->toDateString(),
            $record->clock_in_1,
            $record->clock_out_1,
            $record->clock_in_2,
            $record->clock_out_2,
            $shift
        );

        $record->update($calculated);

        $this->cancelEdit();

        session()->flash('success', 'Weekly attendance record updated successfully.');
    }

    private function formatTime($time): string
    {
        if (! $time) {
            return '';
        }

        return Carbon::parse($time)->format('H:i');
    }

    private function getShift(int $acNo, string $companyCode): array
    {
        // Default MCIC schedule.
        $shift = [
            'morning_start' => '08:00',
            'morning_end' => '12:00',
            'afternoon_start' => '13:00',
            'afternoon_end' => '17:00',
            'morning_grace' => 5,
        ];

        // 4KDC schedule.
        if ($companyCode === '4KDC') {
            $shift = [
                'morning_start' => '07:30',
                'morning_end' => '12:00',
                'afternoon_start' => '13:00',
                'afternoon_end' => '16:30',
                'morning_grace' => 5,
            ];
        }

        // MCIC schedule exceptions.
        if ($companyCode === 'MCIC') {
            if (in_array($acNo, [63, 50], true)) {
                $shift = [
                    'morning_start' => '09:30',
                    'morning_end' => '12:00',
                    'afternoon_start' => '13:00',
                    'afternoon_end' => '18:30',
                    'morning_grace' => 5,
                ];
            }

            if (in_array($acNo, [4, 17, 40, 42, 43, 58, 112, 87, 90, 115], true)) {
                $shift = [
                    'morning_start' => '07:30',
                    'morning_end' => '12:00',
                    'afternoon_start' => '13:00',
                    'afternoon_end' => '16:30',
                    'morning_grace' => 5,
                ];
            }
        }

        return $shift;
    }

    private function calculateAttendance(
        string $date,
        $clockIn1,
        $clockOut1,
        $clockIn2,
        $clockOut2,
        array $shift
    ): array {
        $in1 = $this->toDateTime($date, $clockIn1);
        $out1 = $this->toDateTime($date, $clockOut1);
        $in2 = $this->toDateTime($date, $clockIn2);
        $out2 = $this->toDateTime($date, $clockOut2);

        $morningStart = Carbon::parse($date.' '.$shift['morning_start']);
        $morningEnd = Carbon::parse($date.' '.$shift['morning_end']);
        $afternoonStart = Carbon::parse($date.' '.$shift['afternoon_start']);
        $afternoonEnd = Carbon::parse($date.' '.$shift['afternoon_end']);

        $hasAnyPunch = $in1 || $out1 || $in2 || $out2;
        $hasSecondPair = $in2 || $out2;

        $morningWorked = 0;
        $afternoonWorked = 0;

        // Apply the morning grace period to worked minutes.
        $graceEnd = $morningStart->copy()
            ->addMinutes($shift['morning_grace']);

        $effectiveMorningIn = $in1;

        if (
            $in1 &&
            $in1->greaterThan($morningStart) &&
            $in1->lessThanOrEqualTo($graceEnd)
        ) {
            $effectiveMorningIn = $morningStart->copy();
        }

        if ($hasSecondPair) {
            $morningWorked = $this->minutesBetween(
                $effectiveMorningIn,
                $out1,
                $morningStart,
                $morningEnd
            );

            $afternoonWorked = $this->minutesBetween(
                $in2,
                $out2,
                $afternoonStart,
                $afternoonEnd
            );
        } elseif ($in1 && $out1) {
            if ($in1->greaterThanOrEqualTo($morningEnd)) {
                $afternoonWorked = $this->minutesBetween(
                    $in1,
                    $out1,
                    $afternoonStart,
                    $afternoonEnd
                );
            } else {
                $morningWorked = $this->minutesBetween(
                    $effectiveMorningIn,
                    $out1,
                    $morningStart,
                    $morningEnd
                );

                $afternoonWorked = $this->minutesBetween(
                    $in1,
                    $out1,
                    $afternoonStart,
                    $afternoonEnd
                );
            }
        }

        // Only morning lateness triggers Tardy status.
        $lateMorning = 0;

        if ($in1 && $in1->lessThan($morningEnd)) {
            if ($in1->greaterThan($graceEnd)) {
                $lateMorning = (int) $morningStart->diffInMinutes($in1);
            }
        }

        // Afternoon lateness is recorded but does not independently trigger Tardy.
        $afternoonIn = $hasSecondPair
            ? $in2
            : (
                $in1 && $in1->greaterThanOrEqualTo($morningEnd)
                    ? $in1
                    : null
            );

        $lateAfternoon = 0;

        if ($afternoonIn && $afternoonIn->greaterThan($afternoonStart)) {
            $lateAfternoon = (int) $afternoonStart->diffInMinutes($afternoonIn);
        }

        $isSunday = Carbon::parse($date)->isSunday();

        $isHalfDay = false;

        if (! $isSunday && $hasAnyPunch) {
            $isHalfDay = (
                $morningWorked > 0 && $afternoonWorked === 0
            ) || (
                $afternoonWorked > 0 && $morningWorked === 0
            );
        }

        $status = null;

        if ($hasAnyPunch) {
            $status = $isSunday
                ? 'Sunday'
                : (
                    $isHalfDay
                        ? 'Half Day'
                        : ($lateMorning > 0 ? 'Tardy' : 'Present')
                );
        }

        return [
            'late_minutes_morning' => $lateMorning,
            'late_minutes_afternoon' => $lateAfternoon,
            'total_late_minutes' => $lateMorning + $lateAfternoon,
            'total_minutes_worked' => $morningWorked + $afternoonWorked,
            'is_half_day' => $isHalfDay,
            'status' => $status,
        ];
    }

    private function toDateTime(string $date, $time): ?Carbon
    {
        return $time
            ? Carbon::parse($date.' '.Carbon::parse($time)->format('H:i:s'))
            : null;
    }

    private function minutesBetween(
        ?Carbon $start,
        ?Carbon $end,
        Carbon $shiftStart,
        Carbon $shiftEnd
    ): int {
        if (! $start || ! $end || $end->lessThanOrEqualTo($start)) {
            return 0;
        }

        $actualStart = $start->greaterThan($shiftStart)
            ? $start
            : $shiftStart;

        $actualEnd = $end->lessThan($shiftEnd)
            ? $end
            : $shiftEnd;

        if ($actualEnd->lessThanOrEqualTo($actualStart)) {
            return 0;
        }

        return (int) $actualStart->diffInMinutes($actualEnd);
    }

    public function exportExcel()
    {
        if (! $this->selectedWeekId) {
            $this->addError('export', 'Please select a weekly attendance report first.');

            return;
        }

        $week = WeeklyAttendanceWeek::query()
            ->where('id', $this->selectedWeekId)
            ->where('company_code', $this->companyCode)
            ->first();

        if (! $week) {
            $this->addError('export', 'The selected weekly report could not be found.');

            return;
        }

        $filename = 'Weekly_Attendance_'
            .$week->company_code.'_'
            .str_replace(' ', '_', $week->name ?: $week->start_date->format('Y-m-d'))
            .'.xlsx';

        return Excel::download(
            new WeeklyAttendanceExport($week),
            $filename
        );
    }

    public function render()
    {
        $weeks = WeeklyAttendanceWeek::query()
            ->where('company_code', $this->companyCode)
            ->withCount('records')
            ->orderByDesc('start_date')
            ->get();

        $week = null;
        $records = null;

        if ($this->selectedWeekId !== null) {
            $week = WeeklyAttendanceWeek::query()
                ->where('company_code', $this->companyCode)
                ->whereKey($this->selectedWeekId)
                ->first();

            if ($week) {
                $records = $week->records()
                    ->orderBy('employee_name')
                    ->orderBy('attendance_date')
                    ->paginate(25, ['*'], 'recordsPage');
            } else {
                $this->selectedWeekId = null;
            }
        }

        return view('livewire.attendance.weekly-attendance-report', [
            'weeks' => $weeks,
            'week' => $week,
            'records' => $records,
        ])->layout('components.layouts.app');
    }
}
