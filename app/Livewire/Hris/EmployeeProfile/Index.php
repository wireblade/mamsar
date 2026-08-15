<?php

namespace App\Livewire\Hris\EmployeeProfile;

use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Index extends Component
{
    use withPagination;
    
    public $filter = '';

    #[On('refreshTable')]
    public function refreshTable(){
        
    }

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function getFullname($fname, $mname, $lname){
        $middle = $mname != '' ? strtoupper(substr($mname, 0, 1)) . '.' : '';
        
        return $lname . ', ' . $fname . ' ' .$middle; 

    }

    public function render()
    {
        $employees = Employee::query()
            ->when($this->filter, function ($query) {
                $query->where('fname', 'like', '%' . $this->filter . '%')
                      ->orWhere('mname', 'like', '%' . $this->filter . '%')
                      ->orWhere('lname', 'like', '%' . $this->filter . '%')
                      ->orWhere('empId', 'like', '%' . $this->filter . '%')
                      ->orWhere('position', 'like', '%' . $this->filter . '%');
            })
            ->orderBy('lname', 'asc')
            ->paginate(10); 

        return view('livewire.hris.employee-profile.index', compact('employees'));
    }
}
