<?php

use App\Models\Employee;
use App\Models\EmployeeImage;
use App\Livewire\Employees\DeleteEmployeeModal;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

it('deletes employee images and storage directory when employee is removed', function () {
    Storage::fake('public');

    $employee = Employee::create([
        'fname' => 'John',
        'mname' => 'D',
        'lname' => 'Doe',
        'position' => 'Tester',
        'empId' => 'EMP001',
        'address' => '123 Main St',
        'suffix' => null,
        'dob' => '1990-01-01',
        'status' => 'active',
    ]);

    $pathPrefix = 'employee_pictures/' . $employee->empId . '-' . $employee->fname . '-' . $employee->lname;
    $picturePath = $pathPrefix . '/photo.png';
    $signaturePath = $pathPrefix . '/signature.png';

    Storage::disk('public')->put($picturePath, 'picture-content');
    Storage::disk('public')->put($signaturePath, 'signature-content');

    EmployeeImage::create([
        'employee_id' => $employee->id,
        'picture_path' => $picturePath,
        'signature_path' => $signaturePath,
    ]);

    Livewire::test(DeleteEmployeeModal::class)
        ->set('deleteId', $employee->id)
        ->call('deleteEmployee');

    expect($employee->fresh())->toBeNull();
    Storage::disk('public')->assertMissing($picturePath);
    Storage::disk('public')->assertMissing($signaturePath);
});