<?php

namespace App\Livewire\Rover;

use Livewire\Component;

class CreateTicket extends Component
{
    public function render()
    {
        return view('livewire.rover.create-ticket')->layout('components.layouts.app');
    }
}
