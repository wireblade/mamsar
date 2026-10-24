<?php

namespace App\Livewire\Attendance;

use App\Models\AttendanceCutoff;
use App\Models\AttendanceRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class AttendanceProcessor extends Component
{
    use WithFileUploads;

    public $file;

    public $startDate;

    public $endDate;

    public string $companyCode = 'MCIC';

    public function mount(): void
    {
        $this->startDate = now()->startOfMonth()->toDateString();
        $this->endDate = now()->toDateString();
    }

    public function processAttendance(): void
    {
        $this->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls',
                'max:20480',
            ],
            'startDate' => ['required', 'date'],
            'endDate' => [
                'required',
                'date',
                'after_or_equal:startDate',
            ],
            'companyCode' => [
                'required', 'in:MCIC,4KDC',
            ],
        ]);

        try {
            $spreadsheet = IOFactory::load(
                $this->file->getRealPath()
            );

            try {
                $worksheet = $spreadsheet->getSheet(0);

                $rows = $worksheet->toArray(
                    null,
                    true,
                    true,
                    false
                );

                if (empty($rows)) {
                    throw new \RuntimeException(
                        'The worksheet is empty.'
                    );
                }

                $headers = array_map(
                    fn ($header) => strtolower(trim((string) $header)),
                    array_shift($rows)
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

                $missingHeaders = array_diff(
                    $requiredHeaders,
                    $headers
                );

                if ($missingHeaders) {
                    throw new \RuntimeException(
                        'Missing columns: '.
                        implode(', ', $missingHeaders)
                    );
                }

                $records = [];

                foreach ($rows as $row) {
                    if (count(array_filter(
                        $row,
                        fn ($value) => $value !== null && $value !== ''
                    )) === 0) {
                        continue;
                    }

                    $record = [];

                    foreach ($headers as $index => $header) {
                        $record[$header] = $row[$index] ?? null;
                    }

                    $records[] = $record;
                }

                if (empty($records)) {
                    throw new \RuntimeException(
                        'No attendance records were found.'
                    );
                }
            } finally {
                $spreadsheet->disconnectWorksheets();
            }

            /*
            |--------------------------------------------------------------------------
            | Validate Excel attendance dates against the selected date range
            |--------------------------------------------------------------------------
            */

            $selectedStart = Carbon::parse($this->startDate)->toDateString();
            $selectedEnd = Carbon::parse($this->endDate)->toDateString();

            foreach ($records as $record) {

                $acNo = trim((string) ($record['ac-no.'] ?? ''));

                if ($acNo !== '' && ctype_digit($acNo)) {
                    $acNoNumber = (int) $acNo;

                    $wrongCompany = (
                        $this->companyCode === 'MCIC'
                        && $acNoNumber >= 201
                        && $acNoNumber <= 500
                    ) || (
                        $this->companyCode === '4KDC'
                        && $acNoNumber >= 1
                        && $acNoNumber <= 200
                    );

                    if ($wrongCompany) {
                        $expectedCompany = $this->companyCode === 'MCIC'
                            ? 'MCIC / Zeman (AC-No. 1–200)'
                            : '4KDC (AC-No. 201–500)';

                        $this->addError(
                            'file',
                            'Upload cancelled! The selected company is '.
                            $this->companyCode.
                            ', but AC-No. '.$acNo.
                            ' belongs to the other company range. '.
                            'Please select the correct company. Expected: '.
                            $expectedCompany.
                            '. No attendance records were saved.'
                        );

                        return;
                    }
                }

                $rawDate = $record['date'] ?? null;

                if ($rawDate === null || $rawDate === '') {
                    continue;
                }

                try {
                    if (is_numeric($rawDate)) {
                        $attendanceDate = ExcelDate::excelToDateTimeObject(
                            (float) $rawDate
                        )->format('Y-m-d');
                    } else {
                        $attendanceDate = Carbon::parse($rawDate)->toDateString();
                    }
                } catch (\Throwable $e) {
                    // Keep existing handling for unparseable dates.
                    continue;
                }

                if (
                    $attendanceDate < $selectedStart ||
                    $attendanceDate > $selectedEnd
                ) {
                    $this->addError(
                        'file',
                        'Upload cancelled! The Excel file contains attendance dates outside your selected range ('.
                        $selectedStart.' to '.$selectedEnd.
                        '). Please correct your date range and upload again. No attendance records were saved.'
                    );

                    return;
                }
            }

            /*
             * Attendance calculations will be added next.
             * For now, save the source records temporarily
             * so the next step can process them.
             */

            $results = $this->buildAttendanceResults(
                $records,
                $this->companyCode
            );

            $this->saveAttendanceResults(
                $results,
                $this->companyCode
            );

            $reportDate = Carbon::parse($this->endDate);

            $cutoffStart = $reportDate->day <= 15
                ? $reportDate->copy()->startOfMonth()
                : $reportDate->copy()->day(16);

            $cutoffEnd = $reportDate->day <= 15
                ? $reportDate->copy()->day(15)
                : $reportDate->copy()->endOfMonth();

            $cutoff = AttendanceCutoff::where(
                'company_code',
                $this->companyCode
            )->whereDate(
                'start_date',
                $cutoffStart->toDateString()
            )->whereDate(
                'end_date',
                $cutoffEnd->toDateString()
            )->first();

            if (! $cutoff) {
                $this->addError(
                    'file',
                    'Attendance was processed, but the cutoff report could not be found.'
                );

                return;
            }

            session()->flash(
                'attendance_message',
                'Attendance uploaded successfully for '.
                $this->companyCode.'.'
            );

            $this->redirectRoute('attendance.report', [
                'cutoff' => $cutoff->id,
            ]);

        } catch (\Throwable $e) {
            Log::error('Attendance file processing failed.', [
                'message' => $e->getMessage(),
            ]);

            $this->addError(
                'file',
                'Unable to read this Excel file. Please check its format and column headings.'
            );
        }
    }

    private function getShift(
        string $acNo,
        string $companyCode
    ): array {
        $acNo = trim($acNo);

        // 4KDC schedule
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

        // MCIC exceptions: employees starting at 9:30 AM
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

        // MCIC exceptions: employees starting at 7:30 AM
        if (in_array(
            $acNo,
            ['4', '17', '40', '42', '43', '58', '112', '87', '90', '115'],
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

        // Default MCIC schedule
        return [
            'morning_start' => '08:00',
            'morning_end' => '12:00',
            'afternoon_start' => '13:00',
            'afternoon_end' => '17:00',
            'morning_grace' => 5,
            'afternoon_grace' => 0,
        ];
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

        // Count from the scheduled start if the employee arrives
        // on time or within the morning grace period.
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

    private function buildAttendanceResults(
        array $records,
        string $companyCode
    ): array {
        $employees = [];
        $attendanceByDate = [];

        /*
        |--------------------------------------------------------------------------
        | 1. Read employees and attendance records
        |--------------------------------------------------------------------------
        */

        foreach ($records as $record) {
            $acNo = trim((string) ($record['ac-no.'] ?? ''));
            $name = trim((string) ($record['name'] ?? ''));

            if ($acNo === '' || $name === '') {
                continue;
            }

            $employees[$acNo] = [
                'ac_no' => $acNo,
                'name' => $name,
            ];

            $rawDate = $record['date'] ?? null;

            if ($rawDate === null || $rawDate === '') {
                continue;
            }

            try {
                if (is_numeric($rawDate)) {
                    $date = ExcelDate::excelToDateTimeObject(
                        (float) $rawDate
                    )->format('Y-m-d');
                } else {
                    $date = Carbon::parse($rawDate)->toDateString();
                }
            } catch (\Throwable $e) {
                continue;
            }

            $attendanceByDate[$acNo][$date] = $record;
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Generate attendance for every working day
        |--------------------------------------------------------------------------
        */

        $results = [];

        $start = Carbon::parse($this->startDate)->startOfDay();
        $end = Carbon::parse($this->endDate)->startOfDay();

        foreach ($employees as $acNo => $employee) {
            // This automatically selects the employee's assigned shift.
            $shift = $this->getShift(
                (string) $acNo,
                $companyCode
            );

            for (
                $date = $start->copy();
                $date->lessThanOrEqualTo($end);
                $date->addDay()
            ) {
                // Sundays are not working days.
                if ($date->isSunday()) {
                    continue;
                }

                $dateString = $date->toDateString();

                $record = $attendanceByDate[$acNo][$dateString] ?? [];

                /*
                |--------------------------------------------------------------------------
                | 3. Parse the four possible attendance punches
                |--------------------------------------------------------------------------
                */

                $in1 = $this->parseClockTime(
                    $record['clock in 1'] ?? null,
                    $dateString
                );

                $out1 = $this->parseClockTime(
                    $record['clock out 1'] ?? null,
                    $dateString
                );

                $in2 = $this->parseClockTime(
                    $record['clock in 2'] ?? null,
                    $dateString
                );

                $out2 = $this->parseClockTime(
                    $record['clock out 2'] ?? null,
                    $dateString
                );

                /*
                |--------------------------------------------------------------------------
                | 4. Determine whether the employee has two or four punches
                |--------------------------------------------------------------------------
                |
                | Two punches:
                |   In 1 = arrival
                |   Out 1 = departure after working both sessions
                |
                | Four punches:
                |   In 1 / Out 1 = morning session
                |   In 2 / Out 2 = afternoon session
                |
                */

                $hasAfternoonPunch = $in2 !== null || $out2 !== null;
                $isAfternoonOnly = false;

                if ($hasAfternoonPunch) {
                    // Four-punch attendance: keep sessions separate.
                    $morningIn = $in1;
                    $morningOut = $out1;

                    $afternoonIn = $in2;
                    $afternoonOut = $out2;
                } else {
                    // Two-punch attendance: determine which session was worked.
                    $isAfternoonOnly = $in1 !== null
                        && $in1->format('H:i') >= $shift['morning_end'];

                    if ($isAfternoonOnly) {
                        $morningIn = null;
                        $morningOut = null;

                        $afternoonIn = $in1;
                        $afternoonOut = $out1;
                    } else {
                        $morningIn = $in1;
                        $morningOut = $out1;

                        $afternoonIn = $in1;
                        $afternoonOut = $out1;
                    }
                }
                /*
                |--------------------------------------------------------------------------
                | 5. Calculate worked minutes within assigned shift boundaries
                |--------------------------------------------------------------------------
                */

                $morningInForWork = $morningIn;

                if ($morningIn) {
                    $shiftStart = Carbon::parse(
                        $dateString.' '.$shift['morning_start']
                    );

                    $graceEnd = $shiftStart->copy()->addMinutes(
                        $shift['morning_grace']
                    );

                    if (
                        $morningIn->greaterThan($shiftStart) &&
                        $morningIn->lessThanOrEqualTo($graceEnd)
                    ) {
                        $morningInForWork = $shiftStart;
                    }
                }

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

                $totalMinutesWorked = $morningWorked + $afternoonWorked;

                /*
                |--------------------------------------------------------------------------
                | 6. Calculate lateness
                |--------------------------------------------------------------------------
                |
                | For two-punch attendance, the first clock-in is used
                | for morning lateness. Afternoon lateness is zero because
                | there is no separate afternoon clock-in.
                |
                */

                if ($isAfternoonOnly) {
                    // Afternoon-only attendance must not receive morning lateness.
                    $morningLate = 0;

                    $afternoonLate = $this->calculateLateMinutes(
                        $in1,
                        $shift['afternoon_start'],
                        $shift['afternoon_grace']
                    );
                } else {
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
                }

                /*
                |--------------------------------------------------------------------------
                | 7. Determine half-day and attendance status
                |--------------------------------------------------------------------------
                */

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
                } elseif ($morningLate > 0 || $afternoonLate > 0) {
                    $status = 'TARDY';
                } else {
                    $status = 'PRESENT';
                }

                /*
                |--------------------------------------------------------------------------
                | 8. Save the report row
                |--------------------------------------------------------------------------
                */

                $results[] = [
                    'ac_no' => $acNo,
                    'name' => $employee['name'],
                    'date' => $dateString,

                    'is_half_day' => $isHalfDay,

                    'late_minutes_morning' => $morningLate,
                    'late_minutes_afternoon' => $afternoonLate,
                    'total_late_minutes' => $morningLate + $afternoonLate,

                    'morning_minutes_worked' => $morningWorked,
                    'afternoon_minutes_worked' => $afternoonWorked,
                    'total_minutes_worked' => $totalMinutesWorked,

                    'clock_in_1' => $in1?->format('H:i'),
                    'clock_out_1' => $out1?->format('H:i'),
                    'clock_in_2' => $in2?->format('H:i'),
                    'clock_out_2' => $out2?->format('H:i'),

                    'status' => $status,
                ];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | 9. Sort by date and employee name
        |--------------------------------------------------------------------------
        */

        usort($results, function ($a, $b) {
            return strcasecmp($a['name'], $b['name'])
                ?: strcmp($a['date'], $b['date']);
        });

        return $results;
    }

    private function parseClockTime(
        mixed $value,
        string $date
    ): ?Carbon {
        if ($value === null || $value === '') {
            return null;
        }

        try {
            if (is_numeric($value)) {
                $fraction = (float) $value;

                // Excel time-only values are fractions of a day.
                if ($fraction >= 0 && $fraction < 1) {
                    $seconds = (int) round($fraction * 86400);

                    return Carbon::parse($date)
                        ->startOfDay()
                        ->addSeconds($seconds);
                }

                return Carbon::parse(
                    ExcelDate::excelToDateTimeObject(
                        $fraction
                    )->format('Y-m-d H:i:s')
                );
            }

            $time = trim((string) $value);

            // Excel exports sometimes include a full date and time.
            if (preg_match('/^\d{4}-\d{2}-\d{2}/', $time)) {
                return Carbon::parse($time);
            }

            return Carbon::parse($date.' '.$time);
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function saveAttendanceResults(
        array $results,
        string $companyCode
    ): void {
        DB::transaction(function () use ($results, $companyCode) {
            $recordsByCutoff = [];
            $cutoffs = [];

            foreach ($results as $result) {
                $date = Carbon::parse($result['date']);

                // Determine the cutoff for this attendance date.
                if ($date->day <= 15) {
                    $cutoffStart = $date->copy()->startOfMonth();
                    $cutoffEnd = $date->copy()->day(15);
                } else {
                    $cutoffStart = $date->copy()->day(16);
                    $cutoffEnd = $date->copy()->endOfMonth();
                }

                $startDate = $cutoffStart->toDateString();
                $endDate = $cutoffEnd->toDateString();
                $cutoffKey = $companyCode.'|'.$startDate.'|'.$endDate;

                // Create the cutoff only if it does not exist yet.
                if (! isset($cutoffs[$cutoffKey])) {
                    $cutoffName = $cutoffStart->format('F')
                        .' '.$cutoffStart->day
                        .'–'.$cutoffEnd->day
                        .', '.$cutoffStart->year;

                    $cutoffs[$cutoffKey] = AttendanceCutoff::firstOrCreate(
                        [
                            'company_code' => $companyCode,
                            'start_date' => $startDate,
                            'end_date' => $endDate,
                        ],
                        [
                            'name' => $cutoffName,
                            'uploaded_by' => auth()->id(),
                        ]
                    );
                }

                $cutoff = $cutoffs[$cutoffKey];

                $recordsByCutoff[$cutoff->id][] = [
                    'attendance_cutoff_id' => $cutoff->id,
                    'ac_no' => $result['ac_no'],
                    'employee_name' => $result['name'],
                    'attendance_date' => $result['date'],

                    'clock_in_1' => $result['clock_in_1'],
                    'clock_out_1' => $result['clock_out_1'],
                    'clock_in_2' => $result['clock_in_2'],
                    'clock_out_2' => $result['clock_out_2'],

                    'morning_worked' => $result['morning_minutes_worked'],

                    'afternoon_worked' => $result['afternoon_minutes_worked'],

                    'total_worked' => $result['total_minutes_worked'],
                    'late_minutes' => $result['total_late_minutes'],
                    'is_half_day' => $result['is_half_day'],
                    'status' => $result['status'],
                    'late_minutes_morning' => $result['late_minutes_morning'],
                    'late_minutes_afternoon' => $result['late_minutes_afternoon'],
                ];
            }

            // Update matching employee/date rows; insert new rows otherwise.
            foreach ($recordsByCutoff as $cutoffRecords) {
                AttendanceRecord::upsert(
                    $cutoffRecords,
                    [
                        'attendance_cutoff_id',
                        'ac_no',
                        'attendance_date',
                    ],
                    [
                        'employee_name',
                        'clock_in_1',
                        'clock_out_1',
                        'clock_in_2',
                        'clock_out_2',
                        'morning_worked',
                        'afternoon_worked',
                        'total_worked',
                        'late_minutes',
                        'is_half_day',
                        'status',
                        'updated_at',
                        'late_minutes_morning',
                        'late_minutes_afternoon',
                    ]
                );
            }
        });
    }

    public function render()
    {
        return view(
            'livewire.attendance.attendance-processor'
        )->layout(
            'components.layouts.app',
            ['title' => 'Attendance Processor']
        );
    }
}
