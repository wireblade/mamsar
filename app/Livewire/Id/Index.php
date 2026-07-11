<?php

namespace App\Livewire\Id;

use App\Models\Employee;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search  = '';

    #[On('refreshTable')]
    public function refreshTable()
    {
        // This method is intentionally left empty. It serves as a trigger for Livewire to refresh the component.
    }

    // If you're using Livewire pagination, it's good practice to reset to page 1 whenever the search changes
    public function updatingSearch()
    {
        $this->resetPage();
    }
    // Otherwise, if the user is on page 5 and searches for something with only one page of results, they might see an empty table.

    public function openGovIdModal($id)
    {
        $this->dispatch('open-gov-id-modal', id: $id);
    }

    public function openDeleteEmployeeModal($id)
    {
        $this->dispatch('open-delete-employee-modal', id: $id);
    }

    public function render()
    {
        $employees = Employee::select('id', 'empId', 'fname', 'lname', 'position')
        ->when($this->search, function($query) {
            $query->where(function ($q) {
                $q->where('id', 'like', "%{$this->search}%")
                    ->orWhere('empId', 'like', "%{$this->search}%")
                    ->orWhere('fname', 'like', "%{$this->search}%")
                    ->orWhere('lname', 'like', "%{$this->search}%")
                    ->orWhere('position', 'like', "%{$this->search}%");
                });
            })
            ->orderBy('lname', 'asc')
            ->paginate(10);

        return view('livewire.id.index', [
            'employees' => $employees
        ])->layout('layouts.app.header');
    }
}
