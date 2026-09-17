<?php

namespace App\Livewire\Hris\Company;

use Livewire\Component;

class Index extends Component
{
    public function openCreateCompanyModal()
    {
        $this->dispatch('open-create-company-modal');
    }

    public function render()
    {
        return view('livewire.hris.company.index');
    }
}
