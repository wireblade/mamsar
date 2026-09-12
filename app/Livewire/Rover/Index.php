<?php

namespace App\Livewire\Rover;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.rover.index')->layout('components.layouts.app');
    }
}
