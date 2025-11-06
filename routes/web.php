<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// ===============================
// ========== ADMIN ==============
// ===============================
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\FasilitasController as AdminFasilitasController;
use App\Http\Controllers\Admin\ReservasiRegulerController;
use App\Http\Controllers\Admin\ReservasiPaketController;
use App\Http\Controllers\Admin\ReservasiPenginapanController;
use App\Http\Controllers\Admin\BlogNewsController;
use App\Http\Controllers\Admin\BlogEventController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\GalleryController;

// Setting Profile Controllers
use App\Http\Controllers\Admin\SettingProfile\IdentitasDasarController;
use App\Http\Controllers\Admin\SettingProfile\KontakLokasiController;
use App\Http\Controllers\Admin\SettingProfile\SosialMediaController;

// Backend (Reservasi)
use App\Http\Controllers\Admin\PemesananController;

// ===============================
// ========== USER ===============
// ===============================
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\FasilitasController as UserFasilitasController;
use App\Http\Controllers\User\GalleryController as UserGalleryController;


/*
|--------------------------------------------------------------------------
| Redirect Root
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect('/login'));


/*
|--------------------------------------------------------------------------
| Frontend (User)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

Route::get('/fasilitas', [UserFasilitasController::class, 'index'])->name('fasilitas.index');
Route::get('/fasilitas/{id}', [UserFasilitasController::class, 'show'])->name('fasilitas.show');
Route::get('/galeri', [UserGalleryController::class, 'index'])->name('galeri.index');



/*
|--------------------------------------------------------------------------
| Backend (Admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // --------------------------------
    // Dashboard Admin
    // --------------------------------
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');


    // --------------------------------
    // Management Fasilitas
    // --------------------------------
    Route::resource('fasilitas', AdminFasilitasController::class);

    // --------------------------------
    // Management Galeri
    // --------------------------------
    Route::resource('gallery', GalleryController::class);

    // --------------------------------
    // Management Blog (News & Events)
    // --------------------------------
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::resource('news', BlogNewsController::class);
        Route::resource('events', BlogEventController::class);
    });


    // --------------------------------
    // Management Banner
    // --------------------------------
    Route::resource('banner', BannerController::class);


    // --------------------------------
    // Management Admin & User
    // --------------------------------
    Route::prefix('system')->name('system.')->group(function () {
        Route::resource('admins', UserAdminController::class)->names('admins');
    });

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


    // --------------------------------
    // Management Reservasi
    // --------------------------------
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


    // --------------------------------
    // Setting Profile Perusahaan
    // --------------------------------
    Route::prefix('setting-profile')->name('settingprofile.')->group(function () {
        // Tab 1: Identitas Dasar
        Route::resource('identitas-dasar', IdentitasDasarController::class)->names('identitas');

        // Tab 2: Kontak & Lokasi
        Route::resource('kontak-lokasi', KontakLokasiController::class)->names('kontak');

        // Tab 3: Sosial Media
        Route::resource('sosial-media', SosialMediaController::class)->names('sosial');
    });


    // --------------------------------
    // Management Laporan
    // --------------------------------
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export/excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
    Route::get('/laporan/export/pdf', [LaporanController::class, 'exportPDF'])->name('laporan.export.pdf');
});


/*
|--------------------------------------------------------------------------
| Laravel Breeze Profile
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
require __DIR__ . '/auth.php';
