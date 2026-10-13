<?php

namespace App\Livewire\Hris\Company;

use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

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

    public function getFullName($fname, $middle, $lname)
    {
        $middle = $middle ? strtoupper(substr($middle, 0, 1)).'.' : '';

        return trim($lname.' '.$fname.' '.$middle);
    }

    public function render()
    {
        $departments = Department::query()
            ->with('employees')
            ->where('company_id', $this->id)
            ->orderBy('departments.name', 'asc')
            ->get();

        $employees = Employee::query()
            ->with('empinfo.position.department.company')
            ->whereHas('empinfo.position.department', function ($query) {
                $query->where('company_id', $this->id);
            })
            ->orderBy('lname', 'asc')
            ->paginate(10);

        return view('livewire.hris.company.show', [
            'departments' => $departments,
            'employees' => $employees,
        ]);
    }
}
