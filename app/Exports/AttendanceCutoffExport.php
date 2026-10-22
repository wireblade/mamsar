<?php

namespace App\Exports;

use App\Models\AttendanceCutoff;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AttendanceCutoffExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function __construct(
        private readonly AttendanceCutoff $cutoff
    ) {}

    public function collection(): Collection
    {
        return $this->cutoff->records()
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
            $record->attendance_date->format('Y-m-d'),
            $record->is_half_day ? 'Yes' : '',
            $record->late_minutes_morning,
            $record->late_minutes_afternoon,
            $record->late_minutes,
            $record->total_worked,
            $record->clock_in_1,
            $record->clock_out_1,
            $record->clock_in_2,
            $record->clock_out_2,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true],
            ],
        ];
    }
}
