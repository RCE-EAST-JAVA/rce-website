<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\Admin\AdminStaffController;
use Illuminate\Support\Facades\Route;

// Halaman Publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/proyek', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/staf', [StaffController::class, 'index'])->name('staff.index');

// Redirect Dashboard Dinamis Berdasarkan Role
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('portal.profile');
})->middleware(['auth', 'verified'])->name('dashboard');

// Portal User (Harus Login)
Route::middleware('auth')->prefix('portal')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('portal.profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('portal.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('portal.profile.destroy');
});

// Admin Panel (Harus Login & Admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('projects', AdminProjectController::class)->names('admin.projects');
    Route::resource('staff', AdminStaffController::class)->names('admin.staff');
});

require __DIR__.'/auth.php';
