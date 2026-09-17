<?php

namespace App\Livewire\Hris\Company\Modals;

use Livewire\Component;
use Livewire\Attributes\On;

class CreateCompanyModal extends Component
{

    public $openModal = false;
    
    


    #[On('open-create-company-modal')]
    public function openModal()
    {

    }

    public function render()
    {
        return view('livewire.hris.company.modals.create-company-modal');
    }
}
