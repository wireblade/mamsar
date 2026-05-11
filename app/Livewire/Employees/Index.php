<?php

namespace App\Livewire\Employees;

use App\Models\Employee;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[On('refreshTable')]
    public function refreshTable()
    {
        // This method is intentionally left empty. It serves as a trigger for Livewire to refresh the component.
    }

    public function openAddEmployeeModal()
    {
        $this->dispatch('open-add-employee-modal');
    }

    public function openDeleteEmployeeModal($id)
    {
        $this->dispatch('open-delete-employee-modal', id: $id);
    }

    public function render()
    {
        $employees = Employee::orderBy('lname', 'asc')
            ->paginate(10);

        return view('livewire.employees.index', [
            'employees' => $employees
        ]);
    }
}
