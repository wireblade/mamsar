<?php

namespace App\Livewire\Hris\Department;

use App\Models\Company;
use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public string $companyFilter = '';

    public string $statusFilter = '';

    public $message = '';

    public $type = 'success';

    public bool $show = false;

    #[On('refreshTable')]
    public function refreshTable()
    {
        // Refresh table after add.
    }

    #[On('showAlert')]
    public function showAlert($message, $type)
    {
        $this->message = $message;
        $this->type = $type;
        $this->show = true;
    }

    public function openCreateDepartmentModal()
    {
        $this->dispatch('open-create-department-modal', companyId: $this->companyFilter);
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
            ->paginate(10);

        return view('livewire.hris.department.index', compact('departments', 'companies'));
    }
}
