<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class FlashAlert extends Component
{
    public $message = '';
    public $type = 'success';
    public $show = false;

    public function mount()
    {
        if (session()->has('success')) {
            $this->message = session('success');
            $this->type = 'success';
            $this->show = true;
        } elseif (session()->has('error')) {
            $this->message = session('error');
            $this->type = 'error';
            $this->show = true;
        }
    }

    #[On('showAlert')]
    public function showAlert($message, $type)
    {
        $this->type = $type;
        $this->message = $message;
        $this->show = true;
    }

    public function hideAlert()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.flash-alert');
    }
}
