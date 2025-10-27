<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Admin Controllers
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\ReservasiRegulerController;
use App\Http\Controllers\Admin\ReservasiPaketController;
use App\Http\Controllers\Admin\ReservasiPenginapanController;
use App\Http\Controllers\Admin\BlogNewsController;
use App\Http\Controllers\Admin\BlogEventController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingProfile\IdentitasDasarController;

// Backend (Reservasi)
use App\Http\Controllers\Admin\PemesananController;

// User (Frontend)
use App\Http\Controllers\User\UserDashboardController;

/*
|--------------------------------------------------------------------------
| Redirect Root
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect('/login'));

/*
|--------------------------------------------------------------------------
| Frontend (User) Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Backend (Admin) Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Management Fasilitas
    Route::resource('fasilitas', FasilitasController::class);

    // Blog News & Events
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::resource('news', BlogNewsController::class);
        Route::resource('events', BlogEventController::class);
    });

    // Banner
    Route::resource('banner', BannerController::class);

    // Tambah Admin
    Route::prefix('system')->name('system.')->group(function () {
        Route::resource('admins', UserAdminController::class)->names('admins');
    });

    // Reservasi
    Route::prefix('reservasi')->name('reservasi.')->group(function () {
        Route::resource('reguler', ReservasiRegulerController::class)->names('reguler');
        Route::resource('paket', ReservasiPaketController::class)->names('paket');
        Route::resource('penginapan', ReservasiPenginapanController::class)->names('penginapan');

        // Pemesanan
        Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
        Route::get('/pemesanan/{id}', [PemesananController::class, 'show'])->name('pemesanan.show');
        Route::put('/pemesanan/{id}/status', [PemesananController::class, 'updateStatus'])->name('pemesanan.updateStatus');
        Route::delete('/pemesanan/{id}', [PemesananController::class, 'destroy'])->name('pemesanan.destroy');
    });

    // Akun User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Setting Profile Perusahaan
    Route::prefix('setting-profile')->name('settingprofile.')->group(function () {
        Route::get('/identitas-dasar', [IdentitasDasarController::class, 'index'])->name('identitas.index');
        Route::post('/identitas-dasar', [IdentitasDasarController::class, 'store'])->name('identitas.store');
        Route::delete('/identitas-dasar', [IdentitasDasarController::class, 'destroy'])->name('identitas.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Laravel Breeze (Profile)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
