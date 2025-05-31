<?php

use App\Http\Controllers\Clients\ClientController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Rotas para gerenciamento de clientes
    Route::resource('clients', ClientController::class);
    Route::post('clients/{client}/regenerate-api-key', [ClientController::class, 'regenerateApiKey'])
        ->name('clients.regenerate-api-key');
});

require __DIR__.'/auth.php';
