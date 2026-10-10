<?php

namespace App\Livewire\Hris\Company;

use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use Livewire\Component;

class Show extends Component
{
    public $id = '';

    public $companyName = '';

    public $companyCode = '';

    public $company;

    public $employeeCount;

    public $employeeActive;

    public function mount($id)
    {
        $this->id = $id;

        $this->employeeCount = Employee::whereHas('empinfo.position.department', function ($query) use ($id) {
            $query->where('company_id', $id);
        })->count();

        $this->employeeActive = Employee::whereHas('empinfo.position.department.company', function ($query) use ($id) {
            $query->where('company_id', $id)
                ->where('is_active', 'true');
        })->count();

        $data = $this->company = Company::withCount('departments', 'positions')
            ->findOrFail($id);

        $this->companyName = $data->name;
        $this->companyCode = $data->code;
    }

    public function render()
    {
        $departments = Department::query()
            ->with('employees')
            ->where('company_id', $this->id)
            ->orderBy('departments.name', 'asc')
            ->get();

        $employees = Employee::query()
            ->whereHas('empinfo')
            ->orderBy('lname', 'asc')
            ->get();

        return view('livewire.hris.company.show', [
            'departments' => $departments,
        ]);
    }
}
