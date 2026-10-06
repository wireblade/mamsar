<?php

namespace App\Livewire\Hris\Department;

use App\Models\Company;
use App\Models\Department;
use Livewire\Component;

class Index extends Component
{
    public string $search = '';

    public string $companyFilter = '';

    public string $statusFilter = '';

    public function openCreateDepartmentModal()
    {
        $this->dispatch('open-create-department-modal');
    }

    public function render()
    {
        $companies = Company::query()
            ->orderBy('id')
            ->get();

        $departments = Department::query()
            ->with('company')
            ->withCount('employees')

            ->when($this->search, function ($query) {
                $query->where('name', 'ILIKE', '%'.trim($this->search).'%');
            })

            ->when($this->companyFilter, function ($query) {
                $query->where('company_id', 'ILIKE', "%{$this->companyFilter}%");
            })

            ->when($this->statusFilter !== '', function ($query) {
                $query->where('is_active', $this->statusFilter === '1');
            })

            ->orderBy('company_id', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(20);

        return view('livewire.hris.department.index', compact('departments', 'companies'));
    }
}
