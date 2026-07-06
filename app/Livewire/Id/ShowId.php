<?php

namespace App\Livewire\Id;

use App\Models\Employee;
use Livewire\Component;

class ShowId extends Component
{

    // Employee Information
    public $employeeId = '';
    public $fname = '';
    public $mname = '';
    public $lname = '';
    public $status = '';
    public $dob = '';
    public $suffix = '';
    public $position = '';
    public $address = '';

    // Government IDs
    public $sss = '';
    public $tin = '';
    public $philhealth = '';
    public $pagibig = '';

    // Emergency Contact
    public $iceName = '';
    public $iceNo = '';

    // Image
    public $picture = '';
    public $signature = '';


    public function mount(int $id): void
    {

        $data = Employee::findOrFail($id);

        // Employee Information
        $this->employeeId = $data->empId;
        $this->fname = $data->fname;
        $this->mname = $data->mname;
        $this->lname = $data->lname;
        $this->status = $data->status;
        $this->suffix = $data->suffix;
        $this->address = $data->address;
        $this->position = $data->position;
        $this->dob = $data->dob;

        // Government IDs
        $this->sss = $data->govid?->sss_no ?: 'N/A';
        $this->tin = $data->govid?->tin_no ?: 'N/A';
        $this->philhealth = $data->govid?->philhealth_no ?:'N/A';
        $this->pagibig = $data->govid?->pagibig_no ?: 'N/A';

        // Employee Image
        $this->picture = $data->image?->path.'/'.$data->image?->pic;
        $this->signature = $data->image?->path.'/'.$data->image?->sig;
        
        // Emergency Contact
        $this->iceName = $data->emergency?->contact_name ?? 'N/A';
        $this->iceNo = $data->emergency?->contact_number ?? 'N/A';
    }

    public function getFullNameProperty()
    {
        return strtoupper($this->fname). ' ' .
        ($this->mname ? 
        strtoupper(substr($this->mname, 0, 1)). '. '
        : '' . ' ') . strtoupper($this->lname) . '' .
        ($this->suffix ? ' ' . strtoupper($this->suffix). '.' : '');
    }

    public function render()
    {
        return view('livewire.id.show-id')->layout('components.layouts.app');;
    }
}
