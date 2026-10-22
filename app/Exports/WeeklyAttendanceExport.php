<?php

namespace App\Exports;

use App\Models\WeeklyAttendanceWeek;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class WeeklyAttendanceExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    public function __construct(
        private WeeklyAttendanceWeek $week
    ) {}

    public function collection(): Collection
    {
        return $this->week->records()
            ->orderBy('employee_name')
            ->orderBy('attendance_date')
            ->get();
    }

    public function headings(): array
    {
        return [
            'AC-No.',
            'Name',
            'Date',
            'Is Half Day',
            'Late Minutes Morning',
            'Late Minutes Afternoon',
            'Total Late Minutes',
            'Total Minutes Worked',
            'IN',
            'OUT',
            'IN',
            'OUT',
        ];
    }

    public function map($record): array
    {
        return [
            $record->ac_no,
            $record->employee_name,
            $record->attendance_date,
            $record->is_half_day ? 'Yes' : '',
            $record->late_minutes_morning,
            $record->late_minutes_afternoon,
            $record->total_late_minutes,
            $record->total_minutes_worked,
            $record->clock_in_1,
            $record->clock_out_1,
            $record->clock_in_2,
            $record->clock_out_2,
        ];
    }
}
