<?php

namespace App\Livewire\EmployeeProfile;

use Livewire\Component;
use App\Models\Employee;
use Livewire\Attributes\Url;

class Profile extends Component
{
    public $employee = null;

    #[Url()]
    public $page = 1;
    
    // Employee Information
    public $empId;
    public $fname;
    public $mname;
    public $lname;
    public $suffix;
    public $dob;
    public $position;
    public $status; // to be change to civilStatus in the future
    public $statuss = "Active"; // to be added for status active or inactive
    public $address;

    // Employee Government ID

    public $sss;
    public $tin;
    public $pagibig;
    public $philhealth;

    public $civil_status;

    public $empType = "Regular"; // to be added for employee type in the future

    public $supervisor = "John Doe"; // to be added for supervisor in the future

    public $workLoc = "Main Office"; // to be added for work location in the future
    public $dateHired = "2022-01-01"; // to be added for date hired in the future
    public $contactNumber = "09123456789"; // to be added for contact number in the future
    public $email = "dddssd@test.com"; // to be added for email in the future

    public $gender = "Male"; // to be added for gender in the future
    public $department = "IT"; // to be added for department in the future


    public $profile_photo;


    public function mount(int $employee)
    {
        $employee = Employee::findOrFail($employee);

        $this->empId = $employee->empId;
        $this->fname = $employee->fname;
        $this->mname = $employee->mname;
        $this->lname = $employee->lname;
        $this->suffix = $employee->suffix;
        $this->dob = $employee->dob;
        $this->position = $employee->position;
        $this->address = $employee->address;
        $this->status = $employee->status;

        $this->sss = $employee->govid?->sss_no;
        $this->tin = $employee->govid?->tin_no;
        $this->pagibig = $employee->govid?->pagibig_no;
        $this->philhealth = $employee->govid?->philhealth_no;

        $this->civil_status = $employee->status;
        

        $this->profile_photo = $employee->image?->path. '/' .$employee->image?->pic;
    }

    public function render()
    {
        return view('livewire.employee-profile.profile');
    }
}
