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
        $employees = Employee::where(function ($query){
            $query->where('fname', 'like', '%' . $this->search . '%')
            ->orWhere('lname', 'like', '%' . $this->search . '%');
        })->orderBy('lname', 'asc')->paginate(10);

        return view('livewire.id.index', [
            'employees' => $employees
        ])->layout('layouts.app.header');
    }
}
