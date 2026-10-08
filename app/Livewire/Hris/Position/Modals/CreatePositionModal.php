<?php

namespace App\Livewire\Hris\Position\Modals;

use App\Models\Department;
use App\Models\Position;
use Livewire\Attributes\On;
use Livewire\Component;

class CreatePositionModal extends Component
{
    public $openModal = false;

    // for position if active or not
    public $is_active = true;

    public $positionName;

    public $departmentId;

    public $description;

    public $test = '';

    protected $messages = [
        'positionName.required' => 'Please enter position name',
    ];

    #[On('open-create-position-modal')]
    public function openModal($departmentId)
    {
        $this->departmentId = $departmentId ?: null;
        $this->openModal = true;
    }

    public function addPosition()
    {
        $validate = $this->validate([
            'departmentId' => 'required|exists:departments,id',

            'positionName' => [
                'required',
                'string',
                'max:255',
                function ($attributes, $value, $fail) {
                    if (! $this->departmentId) {
                        return;
                    }

                    $exists = Position::where('department_id', $this->departmentId)
                        ->where('name', 'ILIKE', trim($value))
                        ->exists();
                    if ($exists) {
                        $fail('This Position is already exist in the selected Department');
                    }
                },
            ],

            'description' => 'nullable|string|max:255',
        ]);

        if ($validate) {
            Position::create([
                'department_id' => $this->departmentId,
                'name' => ucwords(strtolower(trim($this->positionName))),
                'description' => $this->description,
                'is_active' => $this->is_active,
            ]);

            $this->reset();

            $this->openModal = false;

            // Refresh Position Index
            $this->dispatch('position-added');

            // Trigger your existing FlashAlert component
            $this->dispatch(
                'showAlert',
                message: 'Position successfully added.',
                type: 'success'
            );
        }

    }

    public function render()
    {
        $departments = Department::with('company')
            ->orderBy('departments.company_id', 'asc')
            ->orderBy('departments.name', 'asc')->get();

        return view('livewire.hris.position.modals.create-position-modal', [
            'departments' => $departments,
        ]);
    }
}
