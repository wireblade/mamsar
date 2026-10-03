<?php

namespace App\Livewire\Hris\Company;

use App\Models\Company;
use Livewire\Component;

class Index extends Component
{
    public function openCreateCompanyModal()
    {
        $this->dispatch('open-create-company-modal');
    }

    public function render()
    {
        $companies = Company::query()
            ->orderBy('id', 'asc')
            ->get();

        return view('livewire.hris.company.index', compact('companies'));
    }
}
