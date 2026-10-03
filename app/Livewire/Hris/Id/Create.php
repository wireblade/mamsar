<?php

namespace App\Livewire\Hris\Id;

use App\Models\Employee;
use App\Models\EmployeeEmergencyContact;
use App\Models\EmployeeEmploymentInfo;
use App\Models\EmployeeGovernmentId;
use App\Models\EmployeeImage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    public $isEditing = false;

    public $title = 'Add Employee';

    use WithFileUploads;

    // Employee fields
    public $fname = '';

    public $mname = '';

    public $lname = '';

    public $suffix = '';

    public $marital_status = '';

    public $dob = '';

    public $company = '';

    public $position = '';

    public $address = '';

    // Emergency Contact fields
    public $contact_name = '';

    public $contact_number = '';

    public $id_number = '';

    // Government ID fields
    public $sss_no = '';

    public $tin_no = '';

    public $pagibig_no = '';

    public $philhealth_no = '';

    // Image fields
    public $picture_path = null;

    public $signature_path = null;

    protected $messages = [
        'id_number.required' => 'The ID No. field is required.',
        'id_number.unique' => 'The ID No. has already been taken.',
        'fname.required' => 'The First Name field is required.',
        'lname.required' => 'The Last Name field is required.',
        'dob.required' => 'The Date of Birth field is required.',
        'position.required' => 'The Position field is required.',
        'address.required' => 'The Address field is required.',
        'contact_name.required' => 'The Emergency Contact Name field is required.',
        'contact_number.required' => 'The Emergency Contact Number field is required.',
        'picture_path.image' => 'The Picture must be an JPEG or PNG image.',
        'signature_path.mimes' => 'The Signature must be a PNG image only.',
    ];

    public function mount()
    {
        $title = $this->title;
    }

    public function save()
    {

        $this->validate([
            'id_number' => 'required|unique:employee_employment_infos,id_number',
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'position' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'sss_no' => 'nullable|string|max:255',
            'tin_no' => 'nullable|string|max:255',
            'pagibig_no' => 'nullable|string|max:255',
            'philhealth_no' => 'nullable|string|max:255',
            'picture_path' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'signature_path' => 'nullable|image|mimes:png|max:2048',
        ]);

        // Check if an employee with the same first and last name already exists
        $exists = Employee::query()
            ->where('fname', $this->fname)
            ->where('lname', $this->lname)
            ->exists();

        // If an employee with the same first and last name exists, add an error message and return
        if ($exists) {
            $this->addError('fname', 'An employee with the same first and last name already exists.');
            $this->addError('lname', 'An employee with the same first and last name already exists.');

            return;
        }

        $data = [
            'fname' => $this->fname,
            'mname' => $this->mname,
            'lname' => $this->lname,
            'suffix' => $this->suffix,
            'dob' => $this->dob ?: null,
            'marital_status' => $this->marital_status,
            'address' => $this->address,
        ];

        $employee = Employee::create($data);

        if ($employee) {

            EmployeeEmploymentInfo::create([
                'employee_id' => $employee->id,
                'id_number' => $this->id_number,
                'employment_status' => $this->position,
            ]);

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

            $dir = 'employees/'.$data['id_number'].'/id';

            if ($this->picture_path) {
                $picture = $this->picture_path->store($dir, 'public');

                $storedPictureName = basename($picture);
            }

            if ($this->signature_path) {
                $signature = $this->signature_path->store($dir, 'public');

                $storedSignatureName = basename($signature);
            }

            EmployeeImage::create([
                'employee_id' => $employee->id,
                'path' => $dir ?? null,
                'pic' => $storedPictureName ?? null,
                'sig' => $storedSignatureName ?? null,
            ]);

        }

        $this->reset();

        session()->flash('success', 'Employee added successfully!');

        return redirect()->route('id.index');
    }

    public function render()
    {
        return view('livewire.hris.id.employee-form')->layout('components.layouts.app')->title('Add Employee');
    }
}
