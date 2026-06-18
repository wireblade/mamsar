<?php

use App\Livewire\Dashboard\Index as DashboardIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\Id\Index as IdIndex;
use App\Livewire\Id\Create as IdCreate;
use App\Livewire\Id\Edit as IdEdit;
use App\Livewire\Id\ShowId;
use App\Livewire\Id\Test;


Route::redirect('/', 'login');


Route::get('/id/', IdIndex::class)->name('id.index');
Route::get('/id/add-employee', IdCreate::class)->name('id.create');
Route::get('/id/{employee}/edit', IdEdit::class)->name('id.edit');
Route::get('/id/{id}/view', ShowId::class)->name('show.id');

Route::get('/test', Test::class)->name('test');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('/home', DashboardIndex::class)->name('home');
});

require __DIR__ . '/settings.php';
