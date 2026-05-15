<?php

namespace App\Livewire\Employees;

use App\Models\Employee;
use Livewire\Component;

class ShowId extends Component
{
    public $employeeId = '';
    public $fname = '';
    public $mname = '';
    public $lname = '';
    public $suffix = '';
    public $position = '';
    public $address = '';
    public $iceName = '';
    public $iceNo = '';
    public $picture = '';
    public $signature = '';

    public function mount(int $id): void
    {

        $data = Employee::findOrFail($id);

        $this->fname = $data->fname;
        $this->mname = $data->mname;
        $this->lname = $data->lname;
        $this->suffix = $data->suffix;
        $this->position = $data->position;

        $this->picture = $data->image?->picture_path;

        $this->signature = $data->image?->signature_path;
        $this->employeeId = $data->empId;
        $this->address = $data->address;
        $this->iceName = $data->emergency?->contact_name ?? 'N/A';
        $this->iceNo = $data->emergency?->contact_number ?? 'N/A';
    }

    public function render()
    {
        return view('livewire.employees.show-id');
    }
}
