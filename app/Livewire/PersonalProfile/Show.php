<?php

namespace App\Livewire\PersonalProfile;

use Livewire\Component;
use App\Models\Employee;

class Show extends Component
{
    public $employee;

    public $fname;
    public $mname;
    public $lname;
    public $suffix;

    public function mount($employee)
    {
        $employee = Employee::findOrFail($employee);

        $this->fname = $employee->fname;
        $this->mname = $employee->mname;
        $this->lname = $employee->lname;
        $this->suffix = $employee->suffix;
    }

    public function render()
    {
        return view('livewire.personal-profile.show');
    }
}
