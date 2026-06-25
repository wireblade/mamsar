<?php

namespace App\Livewire\Id;

use App\Models\Employee;
use App\Models\EmployeeEmergencyContact;
use App\Models\EmployeeGovernmentId;
use App\Models\EmployeeImage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $employee;
    public $isEditing = true;

    // Employee fields
    public $fname;
    public $mname;
    public $lname;
    public $suffix;
    public $status;
    public $dob;
    public $position;
    public $empId;
    public $address;

    // Emergency Contact fields
    public $contact_name;
    public $contact_number;

    // Government ID fields
    public $sss_no;
    public $tin_no;
    public $pagibig_no;
    public $philhealth_no;

    // Image fields
    public $picture_path;
    public $signature_path;

    public function mount($employee)
    {
        $employee = Employee::findOrFail($employee);;

        // Populate Employee fields
        $this->fname = $employee->fname;
        $this->mname = $employee->mname;
        $this->lname = $employee->lname;
        $this->suffix = $employee->suffix;
        $this->dob = $employee->dob;
        $this->status = $employee->status;
        $this->position = $employee->position;
        $this->empId = $employee->empId;
        $this->address = $employee->address;

        // Populate Emergency Contact fields
        $this->contact_name = $employee->emergency?->contact_name;
        $this->contact_number = $employee->emergency?->contact_number;

        // Populate Government ID fields
        $this->sss_no = $employee->govid?->sss_no;
        $this->tin_no = $employee->govid?->tin_no;
        $this->pagibig_no = $employee->govid?->pagibig_no;
        $this->philhealth_no = $employee->govid?->philhealth_no;

        // Populate Image fields
        $this->picture_path = null;
        $this->signature_path = null; // We don't want to pre-populate the signature path for security reasons
    }

    public function save()
    {
        // Validation logic for editing an employee
        $this->validate([
            'empId' => 'required|unique:employees,empId,' . $this->empId . ',empId',
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'position' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'picture_path' => 'nullable|image|mimes:jpeg,png|max:2048',
            // Allow PNG images for signature
            'signature_path' => 'nullable|image|mimes:png|max:2048',
        ]);

        // Update logic for editing an employee
        $employee = Employee::findOrFail($this->employee);

        $employee->update([
            'empId' => $this->empId,
            'fname' => $this->fname,
            'mname' => $this->mname,
            'lname' => $this->lname,
            'suffix' => $this->suffix,
            'dob' => $this->dob ?: null,
            'status' => $this->status,
            'position' => $this->position,
            'address' => $this->address,
        ]);

        $emergency = EmployeeEmergencyContact::updateOrCreate(
            ['employee_id' => $employee->id],
            [
                'contact_name' => $this->contact_name,
                'contact_number' => $this->contact_number,
            ]
        );

        $government = EmployeeGovernmentId::updateOrCreate(
            ['employee_id' => $employee->id],
            [
                'sss_no' => $this->sss_no,
                'tin_no' => $this->tin_no,
                'pagibig_no' => $this->pagibig_no,
                'philhealth_no' => $this->philhealth_no,
            ]
        );
        // Handle picture upload
        if ($this->picture_path) {

            // Delete old picture if it exists
            $oldPicturePath = $employee->image?->picture_path ?? null;
            // Check if the old picture path exists and delete it
            if ($oldPicturePath && Storage::disk('public')->exists($oldPicturePath)) {
                Storage::disk('public')->delete($oldPicturePath);
            }

            // Store the new picture
            $picture = $this->picture_path->store('employee_pictures/' . $this->empId . '-' . $this->fname . '-' . $this->lname, 'public');

            // Update or create the employee image record
           $img =  EmployeeImage::updateOrCreate(
                ['employee_id' => $employee->id],
                ['picture_path' => $picture]
            );
        }

        // Handle signature upload
        if ($this->signature_path) {

            // Delete old signature if it exists
            $oldSignaturePath = $employee->image?->signature_path ?? null;
            // Check if the old signature path exists and delete it
            if ($oldSignaturePath && Storage::disk('public')->exists($oldSignaturePath)) {
                Storage::disk('public')->delete($oldSignaturePath);
            }

            // Store the new signature
            $signature = $this->signature_path->store('employee_pictures/' . $this->empId . '-' . $this->fname . '-' . $this->lname, 'public');
            // Update or create the employee image record
            $sig = EmployeeImage::updateOrCreate(
                ['employee_id' => $employee->id],
                ['signature_path' => $signature]
            );
        }

        // $hasChanges = 
        // $employee->isDirty() ||
        // $emergency->isDirty() ||
        // $government->isDirty() ||
        // (isset($img) && $img->wasChanged()) ||
        // (isset($sig) && $sig->wasChanged());


        // if(! $hasChanges) {
        //     session()->flash('error', 'No changes were made to the employee record.');
        //     return redirect()->route('id.index');
        // }


        session()->flash('success', 'Employee Updated Successfully!');

        return redirect()->route('id.index');
    }

    public function render()
    {
        return view('livewire.id.employee-form')->layout('components.layouts.app');;
    }
}
