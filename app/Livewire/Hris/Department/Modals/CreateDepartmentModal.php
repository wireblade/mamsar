<?php

namespace App\Livewire\Hris\Department\Modals;

use App\Models\Company;
use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateDepartmentModal extends Component
{
    public $openModal = false;

    public $companyId = '';

    public $name = '';

    public $description = '';

    public bool $is_active = true;

    protected $messages = [
        'companyId.required' => 'Please select company.',
        'name.required' => 'Please enter department name.',
    ];

    #[On('open-create-department-modal')]
    public function openModal($companyId)
    {
        $this->companyId = $companyId ?: null;
        $this->openModal = true;
    }

    public function addDepartment()
    {
        $validate = $this->validate([
            'companyId' => 'required|exists:companies,id',

            'name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {

                    if (! $this->companyId) {
                        return;
                    }

                    $exists = Department::where('company_id', $this->companyId)
                        ->where('name', 'ILIKE', trim($value))
                        ->exists();
                    if ($exists) {
                        $fail('This department already exists in the selected company.');
                    }
                },
            ],

            'description' => 'nullable|string|max:255',
        ]);

        if ($validate) {
            Department::create([
                'company_id' => $this->companyId,
                'name' => ucwords(strtolower(trim($this->name))),
                'description' => $this->description,
                'is_active' => $this->is_active,
            ]);

            $this->reset();

            $this->openModal = false;

            $this->dispatch('refreshTable');

            $this->dispatch('showAlert',
                message: 'Department successfully added.',
                type: 'success',
            );

        }

    }

    public function render()
    {
        $companies = Company::query()
            ->orderBy('id', 'asc')
            ->get();

        return view('livewire.hris.department.modals.create-department-modal', [
            'companies' => $companies,
        ]);
    }
}
