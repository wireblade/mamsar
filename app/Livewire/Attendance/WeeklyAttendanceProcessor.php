<?php

namespace App\Livewire\Attendance;

use App\Models\WeeklyAttendanceRecord;
use App\Models\WeeklyAttendanceWeek;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class WeeklyAttendanceProcessor extends Component
{
    use WithFileUploads;

    public $file;

    public string $companyCode = 'MCIC';

    public string $weekStartDate = '';

    public array $results = [];

    public function mount(): void
    {
        $this->weekStartDate = now()
            ->startOfWeek(Carbon::MONDAY)
            ->toDateString();
    }

    public function updatedWeekStartDate(): void
    {
        $this->resetValidation();
    }

    public function processAttendance(): void
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
            'companyCode' => 'required|in:MCIC,4KDC',
            'weekStartDate' => 'required|date',
        ]);

        $monday = Carbon::parse($this->weekStartDate)->startOfDay();

        if (! $monday->isMonday()) {
            throw ValidationException::withMessages([
                'weekStartDate' => 'Please select a Monday as the start of the week.',
            ]);
        }

        $sunday = $monday->copy()->addDays(6)->endOfDay();

        try {
            $spreadsheet = IOFactory::load(
                $this->file->getRealPath()
            );

            $rows = $spreadsheet
                ->getActiveSheet()
                ->toArray(null, true, true, false);

            $spreadsheet->disconnectWorksheets();
            unset($spreadsheet);
        } catch (\Throwable $e) {
            Log::error('Weekly attendance Excel read failed.', [
                'error' => $e->getMessage(),
            ]);

            throw ValidationException::withMessages([
                'file' => 'Unable to read this file. Please check its format.',
            ]);
        }

        if (count($rows) < 2) {
            throw ValidationException::withMessages([
                'file' => 'The Excel file has no attendance records.',
            ]);
        }

        $headers = array_map(
            fn ($header) => strtolower(trim((string) $header)),
            $rows[0]
        );

        $requiredHeaders = [
            'ac-no.',
            'name',
            'date',
            'clock in 1',
            'clock out 1',
            'clock in 2',
            'clock out 2',
        ];

        foreach ($requiredHeaders as $header) {
            if (! in_array($header, $headers, true)) {
                throw ValidationException::withMessages([
                    'file' => "Missing required Excel column: {$header}",
                ]);
            }
        }

        $records = [];
        $errors = [];

        foreach (array_slice($rows, 1) as $index => $row) {
            $row = array_pad($row, count($headers), null);

            $record = array_combine(
                $headers,
                array_slice($row, 0, count($headers))
            );

            if (blank($record['ac-no.'] ?? null)
                && blank($record['date'] ?? null)) {
                continue;
            }

            $acNo = trim((string) ($record['ac-no.'] ?? ''));
            $name = trim((string) ($record['name'] ?? ''));

            if ($acNo === '' || $name === '') {
                $errors[] = 'Row '.($index + 2).': AC-No. and Name are required.';

                continue;
            }

            if (! $this->employeeBelongsToCompany($acNo)) {
                $errors[] = 'Row '.($index + 2).": AC-No. {$acNo} does not belong to {$this->companyCode}.";

                continue;
            }

            try {
                $date = $this->parseExcelDate($record['date'] ?? null);
            } catch (\Throwable) {
                $errors[] = 'Row '.($index + 2).': Invalid attendance date.';

                continue;
            }

            if ($date->lt($monday) || $date->gt($sunday)) {
                $errors[] = 'Row '.($index + 2).': Attendance date is outside the selected Monday–Sunday week.';

                continue;
            }

            $records[] = [
                'ac_no' => $acNo,
                'employee_name' => $name,
                'attendance_date' => $date->toDateString(),
                'clock_in_1' => $this->parseExcelTime($record['clock in 1'] ?? null),
                'clock_out_1' => $this->parseExcelTime($record['clock out 1'] ?? null),
                'clock_in_2' => $this->parseExcelTime($record['clock in 2'] ?? null),
                'clock_out_2' => $this->parseExcelTime($record['clock out 2'] ?? null),
            ];
        }

        if ($errors !== []) {
            throw ValidationException::withMessages([
                'file' => implode(' ', array_slice($errors, 0, 8)),
            ]);
        }

        if ($records === []) {
            throw ValidationException::withMessages([
                'file' => 'No valid attendance records were found.',
            ]);
        }

        $invalidRecords = [];

        foreach ($records as $record) {
            $acNoNumber = (int) ($record['ac_no'] ?? 0);

            $isValidForCompany = match ($this->companyCode) {
                'MCIC' => $acNoNumber >= 1 && $acNoNumber <= 200,
                '4KDC' => $acNoNumber >= 201 && $acNoNumber <= 500,
                default => false,
            };

            if (! $isValidForCompany) {
                $invalidRecords[] = sprintf(
                    'AC-No. %s (%s)',
                    $record['ac_no'] ?? 'Unknown',
                    $record['employee_name'] ?? 'Unknown employee'
                );
            }
        }

        if (! empty($invalidRecords)) {
            $this->addError(
                'file',
                'Upload cancelled. These employees do not belong to the selected company: '
                .implode(', ', array_slice($invalidRecords, 0, 10))
                .(count($invalidRecords) > 10 ? ' and other invalid records.' : '.')
            );

            return;
        }

        DB::transaction(function () use ($records, $monday, $sunday) {
            $week = WeeklyAttendanceWeek::firstOrCreate(
                [
                    'company_code' => $this->companyCode,
                    'start_date' => $monday->toDateString(),
                    'end_date' => $sunday->toDateString(),
                ],
                [
                    'name' => $monday->format('M d').' - '.$sunday->format('M d, Y'),
                    'uploaded_by' => auth()->id(),
                ]
            );

            foreach ($records as $record) {
                $shift = $this->getShift(
                    $record['ac_no'],
                    $this->companyCode
                );

                $calculated = $this->calculateAttendance(
                    $record,
                    $shift
                );

                WeeklyAttendanceRecord::updateOrCreate(
                    [
                        'weekly_attendance_week_id' => $week->id,
                        'ac_no' => $record['ac_no'],
                        'attendance_date' => $record['attendance_date'],
                    ],
                    array_merge($record, $calculated)
                );
            }
        });

        $this->reset('file');

        $this->results = $records;

        $this->dispatch(
            'weekly-attendance-success',
            message: 'Weekly attendance processed successfully.'
        );

    }

    private function employeeBelongsToCompany(string $acNo): bool
    {
        if (! ctype_digit($acNo)) {
            return false;
        }

        $number = (int) $acNo;

        return $this->companyCode === 'MCIC'
            ? $number >= 1 && $number <= 200
            : $number >= 201 && $number <= 500;
    }

    private function parseExcelDate(mixed $value): Carbon
    {
        if ($value === null || $value === '') {
            throw new \InvalidArgumentException('Missing date.');
        }

        if (is_numeric($value)) {
            return Carbon::instance(
                ExcelDate::excelToDateTimeObject((float) $value)
            )->startOfDay();
        }

        return Carbon::parse((string) $value)->startOfDay();
    }

    private function parseExcelTime(mixed $value): ?string
    {
        if ($value === null || trim((string) $value) === '') {
            return null;
        }

        if (is_numeric($value)) {
            $fraction = (float) $value;

            if ($fraction >= 1) {
                $fraction -= floor($fraction);
            }

            $seconds = (int) round($fraction * 86400);
            $seconds %= 86400;

            return sprintf(
                '%02d:%02d:%02d',
                intdiv($seconds, 3600),
                intdiv($seconds % 3600, 60),
                $seconds % 60
            );
        }

        return Carbon::parse((string) $value)->format('H:i:s');
    }

    private function getShift(string $acNo, string $companyCode): array
    {
        if ($companyCode === '4KDC') {
            $shift = [
                'morning_start' => '07:30',
                'morning_end' => '12:00',
                'afternoon_start' => '13:00',
                'afternoon_end' => '16:30',
                'morning_grace' => 5,
                'afternoon_grace' => 0,
            ];
        } else {
            $shift = [
                'morning_start' => '08:00',
                'morning_end' => '12:00',
                'afternoon_start' => '13:00',
                'afternoon_end' => '17:00',
                'morning_grace' => 5,
                'afternoon_grace' => 0,
            ];

            // Employee-specific MCIC schedules.
            if (in_array($acNo, ['63', '50'], true)) {
                $shift = [
                    'morning_start' => '09:30',
                    'morning_end' => '12:00',
                    'afternoon_start' => '13:00',
                    'afternoon_end' => '18:30',
                    'morning_grace' => 5,
                    'afternoon_grace' => 0,
                ];
            } elseif (in_array(
                $acNo,
                ['16', '70', '35', '100', '110', '75', '81', '101'],
                true
            )) {
                $shift = [
                    'morning_start' => '07:30',
                    'morning_end' => '12:00',
                    'afternoon_start' => '13:00',
                    'afternoon_end' => '16:30',
                    'morning_grace' => 5,
                    'afternoon_grace' => 0,
                ];
            }
        }

        // Add further employee-specific shifts here.

        return $shift;
    }

    private function calculateAttendance(
        array $record,
        array $shift
    ): array {
        $date = $record['attendance_date'];

        $in1 = $this->toDateTime($date, $record['clock_in_1']);
        $out1 = $this->toDateTime($date, $record['clock_out_1']);
        $in2 = $this->toDateTime($date, $record['clock_in_2']);
        $out2 = $this->toDateTime($date, $record['clock_out_2']);

        $morningStart = Carbon::parse(
            $date.' '.$shift['morning_start']
        );

        $morningEnd = Carbon::parse(
            $date.' '.$shift['morning_end']
        );

        $afternoonStart = Carbon::parse(
            $date.' '.$shift['afternoon_start']
        );

        $afternoonEnd = Carbon::parse(
            $date.' '.$shift['afternoon_end']
        );

        $hasAnyPunch = $in1 || $out1 || $in2 || $out2;
        $hasSecondPair = $in2 || $out2;

        $morningWorked = 0;
        $afternoonWorked = 0;

        /*
        |--------------------------------------------------------------------------
        | Morning grace period
        |--------------------------------------------------------------------------
        | Clock-ins within the grace period receive full morning work-minute
        | credit. Clock-ins after the grace period use their actual time.
        */

        $morningGraceEnd = $morningStart->copy()
            ->addMinutes($shift['morning_grace']);

        $effectiveMorningIn = $in1;

        if (
            $in1 &&
            $in1->greaterThan($morningStart) &&
            $in1->lessThanOrEqualTo($morningGraceEnd)
        ) {
            $effectiveMorningIn = $morningStart->copy();
        }

        /*
        |--------------------------------------------------------------------------
        | Calculate morning and afternoon worked minutes
        |--------------------------------------------------------------------------
        */

        if ($hasSecondPair) {
            // Separate morning and afternoon punches.

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
                // A single pair beginning after the morning shift is afternoon-only.

                $afternoonWorked = $this->minutesBetween(
                    $in1,
                    $out1,
                    $afternoonStart,
                    $afternoonEnd
                );
            } else {
                // A single pair can cover both scheduled periods.
                // Lunch is excluded automatically.

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

        /*
        |--------------------------------------------------------------------------
        | Morning lateness
        |--------------------------------------------------------------------------
        | Lateness is counted from the scheduled start only when the employee
        | clocks in AFTER the grace period.
        */

        $lateMorning = 0;

        if (
            $in1 &&
            $in1->lessThan($morningEnd) &&
            $in1->greaterThan($morningGraceEnd)
        ) {
            $lateMorning = (int) $morningStart->diffInMinutes($in1);
        }

        /*
        |--------------------------------------------------------------------------
        | Afternoon lateness
        |--------------------------------------------------------------------------
        | Afternoon lateness is recorded but does not independently trigger Tardy.
        */

        $afternoonIn = $hasSecondPair
            ? $in2
            : (
                $in1 && $in1->greaterThanOrEqualTo($morningEnd)
                    ? $in1
                    : null
            );

        $lateAfternoon = 0;

        if (
            $afternoonIn &&
            $afternoonIn->greaterThan($afternoonStart)
        ) {
            $lateAfternoon = (int) $afternoonStart->diffInMinutes(
                $afternoonIn
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Half-day detection
        |--------------------------------------------------------------------------
        */

        $isSunday = Carbon::parse($date)->isSunday();

        $isHalfDay = false;

        if (! $isSunday && $hasAnyPunch) {
            $isHalfDay = (
                $morningWorked > 0 && $afternoonWorked === 0
            ) || (
                $afternoonWorked > 0 && $morningWorked === 0
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Attendance status
        |--------------------------------------------------------------------------
        */

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

    private function toDateTime(string $date, ?string $time): ?Carbon
    {
        return $time
            ? Carbon::parse($date.' '.$time)
            : null;
    }

    public function render()
    {
        return view('livewire.attendance.weekly-attendance-processor')
            ->layout('components.layouts.app');
    }
}
