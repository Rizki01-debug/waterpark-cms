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
use App\Http\Controllers\Admin\NewsletterController as AdminNewsletterController;

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
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\User\ReservasiRegulerController as UserReservasiRegulerController;
use App\Http\Controllers\User\ReservasiPaketController as UserReservasiPaketController;
use App\Http\Controllers\User\ReservasiPenginapanController as UserReservasiPenginapanController;
use App\Http\Controllers\User\BlogNewsController as UserBlogNewsController;
use App\Http\Controllers\User\BlogEventController as UserBlogEventController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\PemesananController as UserPemesananController;



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
Route::middleware(['auth'])->group(function () {
    // 👤 ROUTE UNTUK USER BIASA
    Route::get('/user/profile', [UserProfileController::class, 'index'])->name('user.profile');
    Route::post('/user/profile', [UserProfileController::class, 'update'])->name('user.profile.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/user/pemesanan', [UserPemesananController::class, 'index'])->name('user.pemesanan.index');
    Route::get('/user/pemesanan/{id}/nota', [UserPemesananController::class, 'downloadNota'])->name('user.pemesanan.nota');
    Route::delete('/user/pemesanan/{id}', [UserPemesananController::class, 'destroy'])->name('user.pemesanan.destroy');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

    // --------------------------------
    // Fe Fasilitas
    // --------------------------------
    Route::get('/fasilitas', [UserFasilitasController::class, 'index'])->name('fasilitas.index');
    Route::get('/fasilitas/{id}', [UserFasilitasController::class, 'show'])->name('fasilitas.show');

    // --------------------------------
    // Fe Galeri
    // --------------------------------
    Route::get('/galeri', [UserGalleryController::class, 'index'])->name('galeri.index');

    // --------------------------------
    // Fe newsletter
    // --------------------------------
    Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.store');


    // --------------------------------
    // Fe Reservasi
    // --------------------------------
    Route::get('/reservasi/reguler', [UserReservasiRegulerController::class, 'index'])->name('reservasi.reguler.index');
    Route::get('/reservasi/reguler/{id}', [UserReservasiRegulerController::class, 'show'])
    ->name('reservasi.reguler.show');

    Route::get('/reservasi/paket', [UserReservasiPaketController::class, 'index'])->name('reservasi.paket.index');
    Route::get('/reservasi/paket/{id}', [UserReservasiPaketController::class, 'show'])->name('reservasi.paket.show');

    Route::get('/reservasi/penginapan', [UserReservasiPenginapanController::class, 'index'])
    ->name('reservasi.penginapan.index');

    Route::get('/reservasi/penginapan/{id}', [UserReservasiPenginapanController::class, 'show'])
    ->name('reservasi.penginapan.show');

    // --------------------------------
    // Fe Blog
    // --------------------------------
    Route::get('/blog/news', [UserBlogNewsController::class, 'index'])->name('blog.news.index');
    Route::get('/blog/news/{id}', [UserBlogNewsController::class, 'show'])->name('blog.news.show');

    Route::get('/blog/events', [UserBlogEventController::class, 'index'])->name('blog.events.index');
    Route::get('/blog/events/{id}', [UserBlogEventController::class, 'show'])->name('blog.events.show');


/*
|--------------------------------------------------------------------------
| Backend (Admin)
|--------------------------------------------------------------------------
*/
// 🛠️ ROUTE UNTUK ADMIN
Route::middleware(['auth', 'can:isAdmin'])->group(function () {
    Route::get('/admin/users', [UserAdminController::class, 'index'])->name('admin.users.index');
});

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

    // --------------------------------
    // Management Newsletter
    // --------------------------------
    Route::get('/newsletter', [AdminNewsletterController::class, 'index'])->name('newsletter.index');
    Route::delete('/newsletter/{id}', [AdminNewsletterController::class, 'destroy'])->name('newsletter.destroy');


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
