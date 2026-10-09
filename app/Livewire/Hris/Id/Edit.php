<?php

namespace App\Livewire\Hris\Id;

use App\Models\Employee;
use App\Models\EmployeeEmergencyContact;
use App\Models\EmployeeEmploymentInfo;
use App\Models\EmployeeGovernmentId;
use App\Models\EmployeeImage;
use App\Models\Position;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $id = '';

    public $isEditing = true;

    public $title = 'Edit Employee';

    // Employee fields
    public $fname;

    public $mname;

    public $lname;

    public $suffix;

    public $marital_status;

    public $dob;

    public $company;

    public $position_id;

    public $id_number;

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

    // Department List

    public $positions;

    public function mount($id)
    {
        $this->positions = Position::query()
            ->select('positions.*')
            ->join('departments', 'positions.department_id', '=', 'departments.id')
            ->with('department.company')
            ->orderBy('departments.company_id', 'asc')
            ->orderBy('departments.name', 'asc')
            ->orderBy('name')
            ->get();

        $employee = Employee::with('empinfo.position')
            ->findOrFail($id);

        $this->company = $employee->empinfo?->position?->department?->company?->id;

        $title = $this->title;
        // Populate Employee fields
        $this->fname = $employee->fname;
        $this->mname = $employee->mname;
        $this->lname = $employee->lname;
        $this->suffix = $employee->suffix;
        $this->dob = $employee->dob;
        $this->marital_status = $employee->marital_status;
        $this->position_id = $employee->empinfo?->position_id ?? null;
        $this->id_number = $employee->empinfo?->id_number ?? 'N/A';
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
            // 'empId' => 'required|unique:employees,empId,'.$this->empId.',empId',
            'id_number' => 'required|unique:employee_employment_infos,id_number,'.$this->id_number.',id_number',
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'address' => 'required|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'picture_path' => 'nullable|image|mimes:jpeg,png|max:2048',
            // Allow PNG images for signature
            'signature_path' => 'nullable|image|mimes:png|max:2048',
        ]);

        // Update logic for editing an employee
        $employee = Employee::findOrFail($this->id);

        EmployeeEmergencyContact::updateOrCreate(
            ['employee_id' => $employee->id],
            [
                'contact_name' => $this->contact_name,
                'contact_number' => $this->contact_number,
            ]
        );

        EmployeeGovernmentId::updateOrCreate(
            ['employee_id' => $employee->id],
            [
                'sss_no' => $this->sss_no,
                'tin_no' => $this->tin_no,
                'pagibig_no' => $this->pagibig_no,
                'philhealth_no' => $this->philhealth_no,
            ]
        );

        EmployeeEmploymentInfo::updateOrCreate(
            ['employee_id' => $employee->id],
            [
                'position_id' => $this->position_id, // Assuming the employment status is always active when editing
            ]
        );

        $dir = 'employees/'.$employee->empinfo?->id_number.'/id';

        // Handle picture upload
        if ($this->picture_path) {
            $oldPic = $dir.'/'.$employee->image?->pic;
            if (Storage::disk('public')->exists($oldPic)) {
                Storage::disk('public')->delete($oldPic);
            }
            $picture = $this->picture_path->store($dir, 'public');
            $updates['pic'] = basename($picture);
        }

        // Handle signature upload
        if ($this->signature_path) {
            $oldSig = $dir.'/'.$employee->image?->sig;

            if (Storage::disk('public')->exists($oldSig)) {
                Storage::disk('public')->delete($oldSig);
            }

            $signature = $this->signature_path->store($dir, 'public');
            $updates['sig'] = basename($signature);
        }

        // path
        $updates['path'] = $dir;

        if (! empty($updates)) {
            EmployeeImage::updateOrCreate(
                ['employee_id' => $employee->id],
                $updates,
            );
        }

        $employee->update([
            'fname' => $this->fname,
            'mname' => $this->mname,
            'lname' => $this->lname,
            'suffix' => $this->suffix,
            'dob' => $this->dob ?: null,
            'marital_status' => $this->marital_status,
            'address' => $this->address,
        ]);

        session()->flash('success', 'Employee Updated Successfully!');

        return redirect()->route('id.index');
    }

    public function render()
    {
        return view('livewire.hris.id.employee-form')->layout('components.layouts.app');
    }
}
