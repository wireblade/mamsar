<?php

namespace App\Livewire\Id;

use App\Models\Employee;
use App\Models\EmployeeEmergencyContact;
use App\Models\EmployeeGovernmentId;
use App\Models\EmployeeImage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    public $isEditing = false;

    use WithFileUploads;

    // Employee fields
    public $fname = '';
    public $mname = '';
    public $lname = '';
    public $suffix = '';
    public $status = '';
    public $dob = '';
    public $position = '';
    public $empId = '';
    public $address = '';

    // Emergency Contact fields
    public $contact_name = '';
    public $contact_number = '';

    // Government ID fields
    public $sss_no = '';
    public $tin_no = '';
    public $pagibig_no = '';
    public $philhealth_no = '';

    // Image fields
    public $picture_path = null;
    public $signature_path = null;

    protected $messages = [
        'empId.required' => 'The ID No. field is required.',
        'empId.unique' => 'The ID No. has already been taken.',
        'fname.required' => 'The First Name field is required.',
        'lname.required' => 'The Last Name field is required.',
        'status.required' => 'The Status field is required.',
        'dob.required' => 'The Date of Birth field is required.',
        'position.required' => 'The Position field is required.',
        'address.required' => 'The Address field is required.',
        'contact_name.required' => 'The Emergency Contact Name field is required.',
        'contact_number.required' => 'The Emergency Contact Number field is required.',
        'picture_path.image' => 'The Picture must be an JPEG or PNG image.',
        'signature_path.mimes' => 'The Signature must be a PNG image only.',
    ];

    public function save()
    {

        $this->validate([
            'empId' => 'required|unique:employees,empId',
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'position' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'sss_no' => 'nullable|string|max:255',
            'tin_no' => 'nullable|string|max:255',
            'pagibig_no' => 'nullable|string|max:255',
            'philhealth_no' => 'nullable|string|max:255',
            'picture_path' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'signature_path' => 'nullable|image|mimes:png|max:2048',
        ]);

        $data = [
            'empId' => $this->empId,
            'fname' => $this->fname,
            'mname' => $this->mname,
            'lname' => $this->lname,
            'suffix' => $this->suffix,
            'dob' => $this->dob ?: null,
            'status' => $this->status,
            'position' => $this->position,
            'address' => $this->address,
        ];

        $employee = Employee::create($data);

        EmployeeEmergencyContact::create([
            'employee_id' => $employee->id,
            'contact_name' => $this->contact_name,
            'contact_number' => $this->contact_number,
        ]);

        EmployeeGovernmentId::create([
            'employee_id' => $employee->id,
            'sss_no' => $this->sss_no,
            'tin_no' => $this->tin_no,
            'pagibig_no' => $this->pagibig_no,
            'philhealth_no' => $this->philhealth_no,
        ]);

        if ($this->picture_path) {
            $picture = $this->picture_path->store('employee_pictures/' . $data['empId'], 'public');

            $storedPictureName = basename($picture);
        }

        if ($this->signature_path) {
            $signature = $this->signature_path->store('employee_pictures/' . $data['empId'], 'public');

            $storedSignatureName = basename($signature);
        }
    
        $folderPath = 'employee_pictures/'. $data['empId'];

        EmployeeImage::create([
            'employee_id' => $employee->id,
            'path' => $folderPath ?? null,
            'pic' => $storedPictureName ?? null,
            'sig' => $storedSignatureName ?? null,
        ]);

        $this->reset();

        session()->flash('success', 'Employee added successfully!');

        return redirect()->route('id.index');
    }

    public function render()
    {
        return view('livewire.id.employee-form')->layout('layouts.app.header');;
    }
}
