<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SdgController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebmailController;
use App\Http\Controllers\BimbinganSsoController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\Admin\AdminStaffController;
use App\Http\Controllers\Admin\AdminHeroController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminPartnerController;
use App\Http\Controllers\Admin\AdminUserController;
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

// Direct Login SSO Webmail
Route::get('/webmail/redirect', [WebmailController::class, 'sso'])->name('webmail.sso')->middleware('auth');

// Direct Login SSO Bimbingan
Route::get('/bimbingan/redirect', [BimbinganSsoController::class, 'redirect'])->name('bimbingan.sso')->middleware('auth');

// Redirect Dashboard Dinamis Berdasarkan Hak Akses
Route::get('/dashboard', function () {
    if (auth()->user()->hasAdminAccess()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('portal.profile');
})->middleware(['auth'])->name('dashboard');

// Portal User (Harus Login)
Route::middleware('auth')->prefix('portal')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('portal.profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('portal.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('portal.profile.destroy');
});

// Admin Panel (Harus Login & Akses Admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Program Portfolio (projects)
    Route::middleware('admin:projects,view')->group(function () {
        Route::get('projects', [AdminProjectController::class, 'index'])->name('admin.projects.index');
        Route::middleware('admin:projects,create')->group(function () {
            Route::get('projects/create', [AdminProjectController::class, 'create'])->name('admin.projects.create');
            Route::post('projects', [AdminProjectController::class, 'store'])->name('admin.projects.store');
        });
        Route::middleware('admin:projects,edit')->group(function () {
            Route::get('projects/{project}/edit', [AdminProjectController::class, 'edit'])->name('admin.projects.edit');
            Route::put('projects/{project}', [AdminProjectController::class, 'update'])->name('admin.projects.update');
            Route::patch('projects/{project}', [AdminProjectController::class, 'update'])->name('admin.projects.update');
            Route::post('projects/{project}/toggle-pin', [AdminProjectController::class, 'togglePin'])->name('admin.projects.toggle-pin');
        });
        Route::middleware('admin:projects,delete')->group(function () {
            Route::delete('projects/{project}', [AdminProjectController::class, 'destroy'])->name('admin.projects.destroy');
        });
    });

    // Direktori Staf (staff)
    Route::middleware('admin:staff,view')->group(function () {
        Route::get('staff', [AdminStaffController::class, 'index'])->name('admin.staff.index');
        Route::middleware('admin:staff,create')->group(function () {
            Route::get('staff/create', [AdminStaffController::class, 'create'])->name('admin.staff.create');
            Route::post('staff', [AdminStaffController::class, 'store'])->name('admin.staff.store');
        });
        Route::middleware('admin:staff,edit')->group(function () {
            Route::get('staff/{staff}/edit', [AdminStaffController::class, 'edit'])->name('admin.staff.edit');
            Route::put('staff/{staff}', [AdminStaffController::class, 'update'])->name('admin.staff.update');
            Route::patch('staff/{staff}', [AdminStaffController::class, 'update'])->name('admin.staff.update');
        });
        Route::middleware('admin:staff,delete')->group(function () {
            Route::delete('staff/{staff}', [AdminStaffController::class, 'destroy'])->name('admin.staff.destroy');
        });
    });

    // Foto Hero Banner (hero)
    Route::middleware('admin:hero,view')->group(function () {
        Route::get('hero', [AdminHeroController::class, 'index'])->name('admin.hero.index');
        Route::middleware('admin:hero,create')->group(function () {
            Route::get('hero/create', [AdminHeroController::class, 'create'])->name('admin.hero.create');
            Route::post('hero', [AdminHeroController::class, 'store'])->name('admin.hero.store');
        });
        Route::middleware('admin:hero,edit')->group(function () {
            Route::get('hero/{hero}/edit', [AdminHeroController::class, 'edit'])->name('admin.hero.edit');
            Route::put('hero/{hero}', [AdminHeroController::class, 'update'])->name('admin.hero.update');
            Route::patch('hero/{hero}', [AdminHeroController::class, 'update'])->name('admin.hero.update');
        });
        Route::middleware('admin:hero,delete')->group(function () {
            Route::delete('hero/{hero}', [AdminHeroController::class, 'destroy'])->name('admin.hero.destroy');
        });
    });

    // Publikasi & Artikel (articles)
    Route::middleware('admin:articles,view')->group(function () {
        Route::get('articles', [AdminArticleController::class, 'index'])->name('admin.articles.index');
        Route::middleware('admin:articles,create')->group(function () {
            Route::get('articles/create', [AdminArticleController::class, 'create'])->name('admin.articles.create');
            Route::post('articles', [AdminArticleController::class, 'store'])->name('admin.articles.store');
            Route::post('articles/upload-image', [AdminArticleController::class, 'uploadImage'])->name('admin.articles.upload-image');
        });
        Route::middleware('admin:articles,edit')->group(function () {
            Route::get('articles/{article}/edit', [AdminArticleController::class, 'edit'])->name('admin.articles.edit');
            Route::put('articles/{article}', [AdminArticleController::class, 'update'])->name('admin.articles.update');
            Route::patch('articles/{article}', [AdminArticleController::class, 'update'])->name('admin.articles.update');
            Route::post('articles/{article}/toggle-pin', [AdminArticleController::class, 'togglePin'])->name('admin.articles.toggle-pin');
        });
        Route::middleware('admin:articles,delete')->group(function () {
            Route::delete('articles/{article}', [AdminArticleController::class, 'destroy'])->name('admin.articles.destroy');
        });
    });

    // Mitra & Kolaborator (partners)
    Route::middleware('admin:partners,view')->group(function () {
        Route::get('partners', [AdminPartnerController::class, 'index'])->name('admin.partners.index');
        Route::middleware('admin:partners,create')->group(function () {
            Route::get('partners/create', [AdminPartnerController::class, 'create'])->name('admin.partners.create');
            Route::post('partners', [AdminPartnerController::class, 'store'])->name('admin.partners.store');
        });
        Route::middleware('admin:partners,edit')->group(function () {
            Route::get('partners/{partner}/edit', [AdminPartnerController::class, 'edit'])->name('admin.partners.edit');
            Route::put('partners/{partner}', [AdminPartnerController::class, 'update'])->name('admin.partners.update');
            Route::patch('partners/{partner}', [AdminPartnerController::class, 'update'])->name('admin.partners.update');
        });
        Route::middleware('admin:partners,delete')->group(function () {
            Route::delete('partners/{partner}', [AdminPartnerController::class, 'destroy'])->name('admin.partners.destroy');
        });
    });

    // Manajemen Pengguna (users)
    Route::middleware('admin:users,view')->group(function () {
        Route::get('users', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::middleware('admin:users,create')->group(function () {
            Route::get('users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
            Route::post('users', [AdminUserController::class, 'store'])->name('admin.users.store');
        });
        Route::middleware('admin:users,edit')->group(function () {
            Route::get('users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
            Route::put('users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
            Route::patch('users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
        });
        Route::middleware('admin:users,delete')->group(function () {
            Route::delete('users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
        });
    });
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
