<?php

namespace App\Livewire\Hris\Company\Modals;

use App\Models\Company;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateCompanyModal extends Component
{
    public $openModal = false;

    public $companyCode;

    public $companyName;

    public $companyAddress;

    public $companyDescription;

    #[On('open-create-company-modal')]
    public function openModal()
    {
        $this->openModal = true;
    }

    public function createCompany()
    {
        $this->validate([
            'companyCode' => 'required|string|max:10|unique:companies,code',
            'companyName' => 'required|string|max:255|unique:companies,name',
            'companyAddress' => 'nullable|string|max:500',
            'companyDescription' => 'nullable|string|max:1000',
        ]);

        Company::create([
            'name' => $this->companyName,
            'code' => $this->companyCode,
            'address' => $this->companyAddress,
            'description' => $this->companyDescription,
        ]);

        $this->reset();

        session()->flash('success', 'Company created successfully.');

        $this->openModal = false;

        return redirect()->route('company.index');

    }

    public function render()
    {
        return view('livewire.hris.company.modals.create-company-modal');
    }
}
