<?php

namespace App\Livewire\Hris\Company\Modals;

use Livewire\Attributes\On;
use Livewire\Component;

class CreateCompanyModal extends Component
{
    public $openModal = false;

    #[On('open-create-company-modal')]
    public function openModal()
    {
        $this->openModal = true;
    }

    public function render()
    {
        return view('livewire.hris.company.modals.create-company-modal');
    }
}
