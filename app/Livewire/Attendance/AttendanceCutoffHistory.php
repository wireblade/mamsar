<?php

namespace App\Livewire\Attendance;

use App\Models\AttendanceCutoff;
use Livewire\Component;

class AttendanceCutoffHistory extends Component
{
    public string $search = '';

    public function render()
    {
        $cutoffs = AttendanceCutoff::query()
            ->withCount('records')
            ->when(trim($this->search) !== '', function ($query) {
                $search = trim($this->search);

                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%')
                        ->orWhere('company_code', 'like', '%'.$search.'%');
                });
            })
            ->orderByDesc('start_date')
            ->get();

        return view(
            'livewire.attendance.attendance-cutoff-history',
            [
                'cutoffs' => $cutoffs,
            ]
        )->layout(
            'components.layouts.app',
            ['title' => 'Attendance Cutoff History']
        );
    }
}
