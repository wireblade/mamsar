<?php

namespace App\Livewire\Hris\Id;

use App\Models\Employee;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

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

    public function viewEmployee($id)
    {
        $page = $this->getPage();

        session([
            'id_list' => [
                'page' => $page > 1 ? $page : null,
                'search' => $this->search ?: null,
            ],
        ]);

        return $this->redirectRoute(
            'show.id',
            [
                'id' => $id,
            ],
            navigate: true
        );
    }

    public function render()
    {
        $employees = Employee::query()

        // relationship with table employee_employment_infos
            ->with('empinfo')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('id', 'ILIKE', "%{$this->search}%")
                        ->orWhere('fname', 'ILIKE', "%{$this->search}%")
                        ->orWhere('mname', 'ILIKE', "%{$this->search}%")
                        ->orWhere('lname', 'ILIKE', "%{$this->search}%")
                        ->orWhereHas('empinfo', function ($q) {
                            $q->where('id_number', 'ILIKE', "%{$this->search}%");
                        });

                });
            })
            ->orderBy('lname', 'asc')
            ->paginate(9);

        return view('livewire.hris.id.index', compact('employees'))->layout('layouts.app.header')->title('Mamsar | ID Management');
    }
}
