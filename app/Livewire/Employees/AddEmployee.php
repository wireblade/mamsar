<?php

namespace App\Livewire\Employees;

use Livewire\Component;
use Livewire\WithFileUploads;

class AddEmployee extends Component
{

    use WithFileUploads;

    public $openModal = false;

    public $fname = '';
    public $mname = '';
    public $lname = '';
    public $position = '';
    public $empId = '';
    public $address = '';
    public $iceName = '';
    public $iceNo = '';
    public $picPath = '';
    public $sigPath = '';

    public $picture = '';
    public $signature = '';

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

    public function render()
    {
        return view('livewire.employees.add-employee');
    }
}
