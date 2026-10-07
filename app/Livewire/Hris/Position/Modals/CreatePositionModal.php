<?php

namespace App\Livewire\Hris\Position\Modals;

use Livewire\Attributes\On;
use Livewire\Component;

class CreatePositionModal extends Component
{
    public $openModal = false;

    #[On('open-create-position-modal')]
    public function openModal()
    {
        $this->openModal = true;
    }

    public function render()
    {
        return view('livewire.hris.position.modals.create-position-modal');
    }
}
