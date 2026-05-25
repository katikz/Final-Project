<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;

Route::get('/',function () {
    return redirect()->route('login');
});
// ── Root redirect ──────────────────────────────────────
Route::get('/', fn() => redirect()->route('login'));

// ── Guest-only Auth routes ─────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login',   [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register',[RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ── Authenticated routes ───────────────────────────────
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

    // Staff + Admin — view, create, edit
    Route::middleware('role:admin,staff')->group(function () {
        Route::resource('vehicles', VehicleController::class)->except(['destroy']);
        Route::resource('maintenance', MaintenanceController::class)->except(['destroy']);
    });

    // Admin only — delete + reports + exports
    Route::middleware('role:admin')->group(function () {
        Route::delete('vehicles/{vehicle}',        [VehicleController::class, 'destroy'])->name('vehicles.destroy');
        Route::delete('maintenance/{maintenance}',  [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');

        // ⚠️ Export routes MUST be before Route::resource to avoid conflict
        Route::get('reports/export/excel', [ReportsController::class, 'exportExcel'])->name('reports.export.excel');
        Route::get('reports/export/pdf',   [ReportsController::class, 'exportPdf'])->name('reports.export.pdf');

        Route::resource('reports', ReportsController::class);
    });

});
