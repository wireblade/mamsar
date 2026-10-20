<?php

namespace App\Livewire\Hris\Employee;

use App\Models\Employee;
use Livewire\Component;

class Show extends Component
{
    public $id = '';

    public function mount($id)
    {
        $this->id = $id;
    }

    public function getFullname($fname, $mname, $lname = '')
    {
        $middle = ! empty($mname) ? strtoupper(substr($mname, 0, 1)).'.' : '';

        return trim($lname.', '.$fname.' '.$middle);

    }

    public function render()
    {
        $employee = Employee::with('image', 'empinfo')
            ->find($this->id);

        return view('livewire.hris.employee.show', [
            'employee' => $employee,
        ]);
    }
}
