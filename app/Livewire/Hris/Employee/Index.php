<?php

namespace App\Livewire\Hris\Employee;

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
    public function refreshTable() {}

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getFullname($fname, $mname, $lname)
    {
        $middle = $mname != '' ? strtoupper(substr($mname, 0, 1)).'.' : '';

        return $lname.', '.$fname.' '.$middle;

    }

    public function viewEmployee($id)
    {
        $page = $this->getPage();

        session([
            'employee_list' => [
                'page' => $page > 1 ? $page : null,
                'search' => $this->search ?: null,
            ],
        ]);

        return $this->redirectRoute(
            'employee.show',
            [
                'employee' => $id,
            ],
            navigate: true
        );
    }

    public function render()
    {
        $employees = Employee::query()
            ->with('empinfo')
            ->when($this->search, function ($query) {
                $query->where('fname', 'ILIKE', '%'.$this->search.'%')
                    ->orWhere('mname', 'ILIKE', '%'.$this->search.'%')
                    ->orWhere('lname', 'ILIKE', '%'.$this->search.'%')
                    ->orWhereHas('empinfo', function ($q) {
                        $q->where('employment_status', 'ILIKE', '%'.$this->search.'%');
                    });

            })
            ->orderBy('lname', 'asc')
            ->paginate(10);

        return view('livewire.hris.employee.index', compact('employees'));
    }
}
