<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Index extends Component
{
    public $title = 'MAMSAR';
    public function render()
    {
        $title = $this->title;

        return view('livewire.dashboard.index')->with('title', $title);
    }
}
