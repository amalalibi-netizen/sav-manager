<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Guest routes
Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }

    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'login'])
    ->name('login')
    ->middleware('guest');

Route::post('/authenticate', [AuthController::class, 'authenticate'])
    ->name('authenticate')
    ->middleware('guest');

Route::get('/register', [AuthController::class, 'register'])
    ->name('register')
    ->middleware('guest');

Route::post('/register', [AuthController::class, 'store'])
    ->middleware('guest');

// Authenticated routes
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');

    // Clients
    Route::resource('clients', ClientController::class);

    // Devices
    Route::resource('devices', DeviceController::class);

    // Tickets
    Route::resource('tickets', TicketController::class);

    // Repairs / Interventions
    Route::middleware('can:manage-repairs')->group(function () {
        Route::resource('repairs', RepairController::class);
    });

    // Technicians
    Route::middleware('can:manage-technicians')->group(function () {
        Route::resource('technicians', TechnicianController::class);
    });

    // Spare parts
    Route::middleware('can:manage-spare-parts')->group(function () {
        Route::resource('spare-parts', SparePartController::class);
    });
});