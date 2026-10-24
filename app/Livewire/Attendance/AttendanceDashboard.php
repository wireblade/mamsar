<?php

namespace App\Livewire\Attendance;

use Livewire\Component;

class AttendanceDashboard extends Component
{
    public function render()
    {
        return view('livewire.attendance.attendance-dashboard')
            ->layout('components.layouts.app', [
                'title' => 'Attendance',
            ]);
    }
}
