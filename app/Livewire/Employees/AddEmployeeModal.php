<?php

namespace App\Livewire\Employees;

use Livewire\Component;
use App\Models\Employee;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class AddEmployeeModal extends Component
{
    use WithFileUploads;

    public $openModal = false;

    public $fname;
    public $mname;
    public $lname;
    public $position;
    public $empId;
    public $address;
    public $iceName;
    public $iceNo;
    public $picPath = null;
    public $sigPath = null;

    protected $messages = [
        'empId.required' => 'The ID No. field is required.',
        'empId.unique' => 'The ID No. has already been taken.',
        'fname.required' => 'The First Name field is required.',
        'lname.required' => 'The Last Name field is required.',
        'position.required' => 'The Position field is required.',
        'address.required' => 'The Address field is required.',
        'iceName.required' => 'The Emergency Contact Name field is required.',
        'iceNo.required' => 'The Emergency Contact Number field is required.',
        'picPath.image' => 'The Picture must be an JPEG or PNG image.',
        'sigPath.mimes' => 'The Signature must be a PNG image only.',
    ];


    #[On('open-add-employee-modal')]
    public function openModal()
    {
        $this->openModal = true;
    }

    public function addEmployee()
    {
        $data = $this->validate([
            'empId' => 'required|unique:employees,empId',
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'iceName' => 'required|string|max:255',
            'iceNo' => 'required|string|max:255',
            'picPath' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'sigPath' => 'nullable|image|mimes:png|max:2048',
        ]);

        if ($this->picPath) {
            $picture = $this->picPath->store('employee_pictures/' . $data['empId'] . '-' . $data['fname'] . '-' . $data['lname'], 'public');
        }

        if ($this->sigPath) {
            $signature = $this->sigPath->store('employee_pictures/' . $data['empId'] . '-' . $data['fname'] . '-' . $data['lname'], 'public');
        }

        Employee::create([
            'empId' => $data['empId'],
            'fname' => $data['fname'],
            'mname' => $data['mname'],
            'lname' => $data['lname'],
            'position' => $data['position'],
            'address' => $data['address'],
            'iceName' => $data['iceName'],
            'iceNo' => $data['iceNo'],
            'picPath' => $picture ?? null,
            'sigPath' => $signature ?? null,
        ]);


        $this->reset();

        $this->dispatch('showAlert', type: 'success', message: 'Employee added successfully!');

        $this->openModal = false;

        $this->dispatch('refreshTable');
    }

    public function render()
    {
        return view('livewire.employees.add-employee-modal');
    }
}
