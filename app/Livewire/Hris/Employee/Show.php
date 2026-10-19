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

    public function getFullname()
    {
        $middle = $this->mname != '' ? strtoupper(substr($this->mname, 0, 1)).'.' : '';

        return $this->lname.', '.$this->fname.' '.$middle;

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
