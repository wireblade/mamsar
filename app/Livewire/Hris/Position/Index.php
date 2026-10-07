<?php

namespace App\Livewire\Hris\Position;

use Livewire\Component;

class Index extends Component
{
    public function openCreatePositionModal()
    {
        $this->dispatch('open-create-position-modal');
    }

    public function render()
    {
        return view('livewire.hris.position.index');
    }
}
