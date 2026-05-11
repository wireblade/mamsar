<?php

use App\Livewire\Dashboard\Index as DashboardIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\Employees\Index as EmployeesIndex;
use App\Livewire\Employees\Create as EmployeeCreate;
use App\Livewire\Employees\ShowId;
use App\Livewire\Employees\Test;

Route::get('/', EmployeesIndex::class)->name('home');
Route::get('/add-employee', EmployeeCreate::class)->name('employee.create');
// Route::get('/employees/{employee}/edit', EmployeeForm::class)->name('employee.edit');
Route::get('/id/{id}', ShowId::class)->name('show.id');
Route::get('/test', Test::class)->name('test');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('/home', DashboardIndex::class)->name('home');
});

require __DIR__ . '/settings.php';
