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
        $validate = $this->validate([
            'companyCode' => 'required|string|max:10|unique:companies,code',
            'companyName' => 'required|string|max:255|unique:companies,name',
            'companyAddress' => 'nullable|string|max:500',
            'companyDescription' => 'nullable|string|max:1000',
        ]);

        if ($validate) {
            Company::create([
                'name' => $this->companyName,
                'code' => $this->companyCode,
                'address' => $this->companyAddress ?? null,
                'description' => $this->companyDescription ?? null,
            ]);
        }

        $this->reset();

        session()->flash('success', 'Company added successfully.');

        $this->openModal = false;

        return redirect()->route('company.index');

    }

    public function render()
    {
        return view('livewire.hris.company.modals.create-company-modal');
    }
}
