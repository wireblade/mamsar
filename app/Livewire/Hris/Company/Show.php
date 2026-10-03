<?php

namespace App\Livewire\Hris\Company;

use App\Models\Company;
use Livewire\Component;

class Show extends Component
{
    public $id = '';

    public $companyName = '';

    public $companyCode = '';

    public function mount($company)
    {

        $company = Company::query()
            ->where('code', $company)
            ->firstOrFail();

        $this->companyName = $company->name;
        $this->companyCode = $company->code;
    }

    public function render()
    {
        return view('livewire.hris.company.show');
    }
}
