<?php

namespace App\Livewire\Hris\Employee;

use App\Models\Company;
use App\Models\Department;
use Livewire\Component;

class Create extends Component
{
    public $fname = '';

    public $mname = '';

    public $lname = '';

    public $suffix = '';

    public $gender = '';

    public $dob = '';

    public $marital_status = '';

    public $address = '';

    public $contact_number = '';

    public $companyId = '';

    public $departmentId = '';

    public $positionId = '';

    public $emergency_name = '';

    public $emergency_relationship = '';

    public $emergency_phone = '';

    // this is to reset the department and position id when select new company
    public function updatedCompanyId()
    {
        $this->departmentId = '';
        $this->positionId = '';
    }

    // this is to reset the position id when select new department
    public function updatedDepartmentId()
    {
        $this->positionId = '';
    }

    public function render()
    {

        $companies = Company::orderBy('id')
            ->get();

        $departments = $this->companyId ? Department::where('company_id', $this->companyId)
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            : collect();

        $positions = $this->departmentId ? Department::where('company_id', $this->companyId)
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            : collect();

        return view('livewire.hris.employee.create', [
            'companies' => $companies,
            'departments' => $departments,
            'positions' => $positions,
        ]);
    }
}
