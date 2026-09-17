<?php

use App\Livewire\Dashboard\Index as DashboardIndex;
use Illuminate\Support\Facades\Route;

// This is for the ID Management
use App\Livewire\Hris\Id\Index as IdIndex;
use App\Livewire\Hris\Id\Create as IdCreate;
use App\Livewire\Hris\Id\Edit as IdEdit;
use App\Livewire\Hris\Id\ShowId;

// This is for the Employee management
use App\Livewire\Hris\Employee\Index as EmployeeIndex;
use App\Livewire\Hris\Employee\Show as EmployeeShow;

// This is for the Company management
use App\Livewire\Hris\Company\Index as CompanyIndex;
use App\Livewire\Hris\Company\Show as CompanyShow;

// This is for the Department management
use App\Livewire\Hris\Department\Index as DepartmentIndex;

// This is for the Position management
use App\Livewire\Hris\Position\Index as PositionIndex;

// This is for the Rover management
use App\Livewire\Rover\Index as RoverIndex;
use App\Livewire\Rover\CreateTicket as RoverCreateTicket;

Route::redirect('/', 'login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('hris/dashboard', 'dashboard')->name('dashboard');

    // This is for the profile management
    Route::get('hris/employee/', EmployeeIndex::class)->name('employee.index');
    Route::get('hris/employee/{employee}', EmployeeShow::class)->name('employee.show');

    // This is for the company management
    Route::get('hris/company/', CompanyIndex::class)->name('company.index');
    Route::get('hris/company/{company}', CompanyShow::class)->name('company.show');

    // This is for the department management
    Route::get('hris/department/', DepartmentIndex::class)->name('department.index');

    Route::get('hris/position/', PositionIndex::class)->name('position.index');

    // This is for the ID Management
    Route::get('hris/id', IdIndex::class)->name('id.index');
    Route::get('hris/id/add-employee', IdCreate::class)->name('id.create');
    Route::get('hris/id/{employee}/edit', IdEdit::class)->name('id.edit');
    Route::get('hris/id/{id}/view', ShowId::class)->name('show.id');

    Route::get('/home', DashboardIndex::class)->name('home');
});


    Route::get('rover/', RoverIndex::class)->name('rover.index');
    Route::get('rover/create-ticket/', RoverCreateTicket::class)->name('rover.create-ticket');

require __DIR__ . '/settings.php';
