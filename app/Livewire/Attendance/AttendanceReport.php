<?php

namespace App\Livewire\Attendance;

use App\Exports\AttendanceCutoffExport;
use App\Models\AttendanceCutoff;
use App\Models\AttendanceRecord;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceReport extends Component
{
    use WithPagination;

    public $cutoffId;

    public string $search = '';

    public string $statusFilter = 'ALL';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatusFilter(): void
    {
        $this->resetPage();
    }

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

        // Load only the cutoff details, not all attendance records.
        return AttendanceCutoff::find($this->cutoffId);
    }

    public function getFilteredResultsProperty()
    {
        if (! $this->cutoffId) {
            return AttendanceRecord::query()
                ->whereRaw('1 = 0')
                ->paginate(200);
        }

        $search = trim($this->search);

        return AttendanceRecord::query()
            ->where('attendance_cutoff_id', $this->cutoffId)
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->whereRaw(
                        'CAST(ac_no AS TEXT) ILIKE ?',
                        ['%'.$search.'%']
                    )->orWhere('employee_name', 'ILIKE', '%'.$search.'%');
                });
            })
            ->when($this->statusFilter !== 'ALL', function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy('employee_name')
            ->orderBy('attendance_date')
            ->paginate(200)
            ->through(fn ($record) => [
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
            ]);
    }

    public function exportExcel()
    {
        $cutoff = $this->cutoff;

        if (! $cutoff) {
            $this->addError('export', 'Please select an attendance cutoff first.');

            return;
        }

        $filename = 'Attendance_'
            .$cutoff->company_code.'_'
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
