<?php

namespace App\Livewire\Hris\Position\Modals;

use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\Component;

class CreatePositionModal extends Component
{
    public $openModal = false;

    public $is_active = true;

    public $departments;

    #[On('open-create-position-modal')]
    public function openModal()
    {
        $this->openModal = true;
    }

    public function mount()
    {
        $this->departments = Department::with('company')->get();
    }

    public function render()
    {
        return view('livewire.hris.position.modals.create-position-modal');
    }
}
