<?php

namespace App\Livewire\Hris\Position;

use App\Models\Company;
use App\Models\Department;
use App\Models\Position;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $companyFilter = '';

    public $departmentFilter = '';

    public $statusFilter = '';

    public function openCreatePositionModal()
    {
        $this->dispatch('open-create-position-modal');
    }

    public function render()
    {
        $companies = Company::query()
            ->orderBy('id', 'asc')
            ->get();

        $departments = Department::query()
            ->where('is_active', true)
            ->when($this->companyFilter, function ($query) {
                $query->where('company_id', $this->companyFilter);
            })
            ->orderBy('name')
            ->get();

        $positions = Position::query()
            ->select('positions.*')
            ->join('departments', 'positions.department_id', '=', 'departments.id')
            ->with('department.company')
            ->withCount('empinfo')

            ->when($this->search, function ($query) {
                $query->where('positions.name', 'ILIKE', '%'.trim($this->search).'%');
            })

            ->when($this->companyFilter, function ($query) {
                $query->whereHas('department', function ($q) {
                    $q->where('company_id', $this->companyFilter);
                });
            })

            ->when($this->departmentFilter, function ($query) {
                $query->where('department_id', $this->departmentFilter);
            })

            ->when($this->statusFilter !== '', function ($query) {
                $query->where('positions.is_active', $this->statusFilter === '1');
            })

            ->orderBy('departments.company_id', 'asc')
            ->orderBy('departments.name', 'asc')
            ->orderBy('positions.name', 'asc')

            ->paginate(10);

        return view('livewire.hris.position.index', [
            'companies' => $companies,
            'departments' => $departments,
            'positions' => $positions,
        ]);
    }
}
