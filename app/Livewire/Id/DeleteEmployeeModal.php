<?php

namespace App\Livewire\Id;

use Livewire\Component;
use App\Models\Employee;
use App\Models\EmployeeImage;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class DeleteEmployeeModal extends Component
{
    public $openModal = false;

    public $deleteId;

    public $empId;
    public $fullname;

    #[On('open-delete-employee-modal')]
    public function openModal($id)
    {
        $this->openModal = true;

        $data = Employee::findOrFail($id);

        $this->deleteId = $id;

        $this->empId = $data->empId;

        $this->fullname = ucfirst($data->fname) . ($data->mname) ? ' ' . strtoupper(substr($data->mname, 0, 1)) . '.' . ' ' . ucfirst($data->lname) : '' . ucfirst($data->lname);
    }

    public function deleteEmployee()
    {
        $employee = Employee::findOrFail($this->deleteId);

        $image = EmployeeImage::where('employee_id', $this->deleteId)->first();

        if ($image) {
            if ($image->picture_path) {
                Storage::disk('public')->delete($image->picture_path);
            }

            if ($image->signature_path) {
                Storage::disk('public')->delete($image->signature_path);
            }
        }

        $employeeStorage = 'employee_pictures/' . $employee->empId . '-' . $employee->fname . '-' . $employee->lname;
        if (Storage::disk('public')->exists($employeeStorage)) {
            Storage::disk('public')->deleteDirectory($employeeStorage);
        }

        $employee->delete();

        $this->openModal = false;

        $this->dispatch('showAlert', type: 'success', message: 'Employee deleted successfully!');

        $this->dispatch('refreshTable');
    }

    public function render()
    {
        return view('livewire.id.delete-employee-modal');
    }
}
