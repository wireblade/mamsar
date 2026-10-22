<?php

namespace App\Livewire\Attendance;

use App\Exports\AttendanceCutoffExport;
use App\Models\AttendanceCutoff;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceReport extends Component
{
    public $cutoffId;

    public string $search = '';

    public string $statusFilter = 'ALL';

    public function mount(): void
    {
        $cutoffId = request()->query('cutoff');

        if ($cutoffId) {
            $this->cutoffId = $cutoffId;

            return;
        }

        // Keep compatibility with the current temporary report flow.
        $token = session('attendance_report_token');

        if ($token) {
            $report = cache()->get('attendance_report:'.$token);

            if (is_array($report)) {
                return;
            }
        }

        $this->redirectRoute('attendance.index');
    }

    public function getCutoffProperty(): ?AttendanceCutoff
    {
        if (! $this->cutoffId) {
            return null;
        }

        return AttendanceCutoff::with('records')
            ->find($this->cutoffId);
    }

    public function getFilteredResultsProperty(): array
    {
        $cutoff = $this->cutoff;

        if (! $cutoff) {
            return [];
        }

        return $cutoff->records
            ->filter(function ($record) {
                $search = strtolower(trim($this->search));

                $matchesSearch = $search === ''
                    || str_contains(
                        strtolower((string) $record->ac_no),
                        $search
                    )
                    || str_contains(
                        strtolower((string) $record->employee_name),
                        $search
                    );

                $matchesStatus = $this->statusFilter === 'ALL'
                    || $record->status === $this->statusFilter;

                return $matchesSearch && $matchesStatus;
            })
            ->sortBy([
                ['employee_name', 'asc'],
                ['attendance_date', 'asc'],
            ])
            ->values()
            ->map(fn ($record) => [
                'ac_no' => $record->ac_no,
                'name' => $record->employee_name,
                'date' => $record->attendance_date->toDateString(),
                'is_half_day' => $record->is_half_day,
                'late_minutes_morning' => $record->late_minutes_morning,
                'late_minutes_afternoon' => $record->late_minutes_afternoon,
                'total_late_minutes' => $record->late_minutes,
                'total_minutes_worked' => $record->total_worked,
                'clock_in_1' => $record->clock_in_1
                    ? substr((string) $record->clock_in_1, 0, 5)
                    : null,
                'clock_out_1' => $record->clock_out_1
                    ? substr((string) $record->clock_out_1, 0, 5)
                    : null,
                'clock_in_2' => $record->clock_in_2
                    ? substr((string) $record->clock_in_2, 0, 5)
                    : null,
                'clock_out_2' => $record->clock_out_2
                    ? substr((string) $record->clock_out_2, 0, 5)
                    : null,
                'status' => $record->status,
            ])
            ->all();
    }

    public function exportExcel()
    {
        $cutoff = $this->cutoff;

        if (! $cutoff) {
            $this->addError('export', 'Please select an attendance cutoff first.');

            return;
        }

        $filename = 'Attendance_'
            .str_replace(' ', '_', $cutoff->name)
            .'.xlsx';

        return Excel::download(
            new AttendanceCutoffExport($cutoff),
            $filename
        );
    }

    public function render()
    {
        $cutoff = $this->cutoff;

        return view(
            'livewire.attendance.attendance-report',
            [
                'filteredResults' => $this->filteredResults,
                'cutoff' => $cutoff,
                'startDate' => $cutoff?->start_date->toDateString() ?? '',
                'endDate' => $cutoff?->end_date->toDateString() ?? '',
            ]
        )->layout(
            'components.layouts.app',
            ['title' => 'Attendance Report']
        );
    }
}
