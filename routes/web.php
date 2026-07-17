<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SdgController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\Admin\AdminStaffController;
use App\Http\Controllers\Admin\AdminHeroController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminPartnerController;
use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Models\Article;

// Halaman Publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/proyek', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/proyek/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/staf', [StaffController::class, 'index'])->name('staff.index');
Route::get('/staf/{staff}', [StaffController::class, 'show'])->name('staff.show');
Route::get('/sdg', [SdgController::class, 'index'])->name('sdg.index');
Route::get('/sdg/{number}', [SdgController::class, 'show'])->name('sdg.show')->where('number', '[0-9]+');

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
    Route::resource('hero', AdminHeroController::class)->names('admin.hero')->except(['show']);
    Route::resource('articles', AdminArticleController::class)->names('admin.articles')->except(['show']);
    Route::post('articles/upload-image', [AdminArticleController::class, 'uploadImage'])->name('admin.articles.upload-image');
    Route::post('articles/{article}/toggle-pin', [AdminArticleController::class, 'togglePin'])->name('admin.articles.toggle-pin');
    Route::post('projects/{project}/toggle-pin', [AdminProjectController::class, 'togglePin'])->name('admin.projects.toggle-pin');
    Route::resource('partners', AdminPartnerController::class)->names('admin.partners')->except(['show']);
});

// Route untuk sitemap XML
Route::get('/sitemap.xml', function () {
    $projects = Project::all();
    $articles = Article::published()->get();
    return response()->view('sitemap', [
        'projects' => $projects,
        'articles' => $articles,
    ])->header('Content-Type', 'text/xml');
});

require __DIR__.'/auth.php';
