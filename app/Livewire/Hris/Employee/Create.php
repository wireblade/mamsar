<?php

namespace App\Livewire\Hris\Employee;

use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeEmergencyContact;
use App\Models\EmployeeEmploymentInfo;
use App\Models\Position;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    // employees table
    public $fname = '';

    public $mname = '';

    public $lname = '';

    public $suffix = '';

    public $gender = '';

    public $dob = '';

    public $marital_status = '';

    public $address = '';

    public $contact_number = '';

    // employee_employment_infos table
    public $id_number = '';

    public $companyId = '';

    public $departmentId = '';

    public $positionId = '';

    // employee_emergency_contacts table
    public $emergency_name = '';

    public $emergency_relationship = '';

    public $emergency_phone = '';

    protected $messages = [
        'fname.unique' => 'This employee already exists.',
        'lname.unique' => 'This employee already exists.',
        'fname.required' => 'Please enter First Name.',
        'lname.required' => 'Please enter Last Name.',
        'gender.required' => 'Pqlease select gender.',
        'emergency_name.required_with' => 'Please enter contact person details if you select relationship or enter contact number',
        'emergency_relationship.required_with' => 'Please select relationship if you enter contact person details.',
        'emergency_phone.required_with' => 'Please enter contact number if you enter contact person details.',
    ];

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

    public function saveEmployee()
    {
        $validate = $this->validate([
            'id_number' => 'nullable|unique:employee_employment_infos,id_number',
            'fname' => [
                'required',
                'string',
                'max:255',
                Rule::unique('employees', 'fname')
                    ->where('lname', $this->lname),
            ],
            'mname' => 'nullable|string|max:255',
            'lname' => [
                'required',
                'string',
                'max:255',
                Rule::unique('employees', 'lname')
                    ->where('fname', $this->fname),
            ],
            'suffix' => 'nullable|string|max:255',
            'gender' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'marital_status' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'contact_number' => 'required|string|max:255',
            'positionId' => 'nullable',
            'emergency_name' => 'nullable|string|max:255|required_with:emergency_relationship,emergency_phone',
            'emergency_relationship' => 'nullable|string|max:255|required_with:emergency_name',
            'emergency_phone' => 'nullable|string|max:255|required_with:emergency_name',
        ]);

        if ($validate) {

            $employeeDetails = [
                'fname' => $this->fname,
                'mname' => $this->mname,
                'lname' => $this->lname,
                'suffix' => $this->suffix,
                'dob' => $this->dob,
                'address' => $this->address,
                'marital_status' => $this->marital_status,
                'gender' => $this->gender,
                'contactNumber' => $this->contact_number,
            ];

            $employee = Employee::create($employeeDetails);

            if ($employee) {
                EmployeeEmploymentInfo::create([
                    'employee_id' => $employee->id,
                    'id_number' => $this->id_number,
                    'position_id' => $this->positionId,
                ]);

                EmployeeEmergencyContact::create([
                    'employee_id' => $employee->id,
                    'contact_name' => $this->emergency_name,
                    'contact_number' => $this->emergency_phone,
                    'relation' => $this->emergency_relationship,
                ]);
            }

            $this->reset();

            session()->flash('success', 'Employee successfully added.');

            redirect()->route('employee.index');

        }

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

        $positions = $this->departmentId ? Position::where('department_id', $this->departmentId)
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            : collect();

        return view('livewire.hris.employee.employee-form', [
            'companies' => $companies,
            'departments' => $departments,
            'positions' => $positions,
        ]);
    }
}
