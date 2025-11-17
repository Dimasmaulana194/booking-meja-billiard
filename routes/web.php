<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\MejaVIPController;
use App\Http\Controllers\MejaRegularController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Halaman Utama (Dashboard Admin)
|--------------------------------------------------------------------------
*/
Route::get('/', [AdminController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

/*
|--------------------------------------------------------------------------
| Authentication (Guest Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['guest', 'throttle:5,1'])->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/forgot-password',        [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password',       [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password',        [AuthController::class, 'resetPassword'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Midtrans Webhook (tanpa auth & csrf)
|--------------------------------------------------------------------------
*/
Route::post('/pembayaran/notification', [PembayaranController::class, 'handleNotification'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
    ->name('pembayaran.notification');

/*
|--------------------------------------------------------------------------
| User Authenticated
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Halaman pengguna
    Route::get('/beranda',      [BerandaController::class, 'index'])->name('beranda');
    Route::get('/meja-vip',     [MejaVIPController::class, 'index'])->name('meja-vip');
    Route::get('/meja-regular', [MejaRegularController::class,'index'])->name('meja-regular');

    // App page (UserController@menu)
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/menu', [UserController::class, 'menu'])->name('menu');
    });

    // Pembayaran & Transaksi
    Route::prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::get('/{id}/{harga}/{asal}', [PembayaranController::class, 'show'])
            ->where([
                'id' => '[0-9]+',
                'harga' => '[0-9]+(\.[0-9]{1,2})?', // support desimal
                'asal' => '(vip|regular)',
            ])
            ->name('show');

        Route::post('/simpan', [PembayaranController::class, 'simpanPembayaran'])->name('simpan');
        Route::get('/transaksi', [PembayaranController::class, 'daftarTransaksi'])->name('transaksi');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes (auth + admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // App page under admin
    Route::get('/app', function () {
        return view('app'); // resources/views/app.blade.php
    })->name('app');

    // Manajemen Meja
    Route::prefix('meja')->name('meja.')->group(function () {
        Route::get('/',             [MejaController::class, 'index'])->name('index');
        Route::get('/create',       [MejaController::class, 'create'])->name('create');
        Route::post('/',            [MejaController::class, 'store'])->name('store');
        Route::get('/{meja}/edit',  [MejaController::class, 'edit'])->name('edit');
        Route::put('/{meja}',       [MejaController::class, 'update'])->name('update');
        Route::delete('/{meja}',    [MejaController::class, 'destroy'])->name('destroy');
    });

    // Manajemen User
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/',          [AdminController::class, 'daftarUser'])->name('index');
        Route::get('/create',    [AdminController::class, 'createUser'])->name('create');
        Route::post('/',         [AdminController::class, 'storeUser'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'editUser'])->name('edit');
        Route::put('/{id}',      [AdminController::class, 'updateUser'])->name('update');
        Route::delete('/{id}',   [AdminController::class, 'deleteUser'])->name('delete');
    });
    Route::get('/pembayaran/{mejaId}', [PembayaranController::class, 'showPaymentPage'])->name('pembayaran.page');
    Route::get('/', [BerandaController::class, 'index'])->name('beranda');
    // Manajemen Transaksi
    Route::prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('/',          [AdminController::class, 'daftarTransaksi'])->name('index');
        Route::get('/{id}/edit', [AdminController::class, 'editTransaction'])->name('edit');
        Route::put('/{id}',      [AdminController::class, 'updateTransaction'])->name('update');
        Route::delete('/{id}',   [AdminController::class, 'deleteTransaction'])->name('delete');
    });
});
Route::get('/pembayaran/sukses', function () {
    return view('pembayaran.sukses'); // pastikan view ini ada
})->name('pembayaran.sukses');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/pembayaran/sukses', [PembayaranController::class, 'sukses'])->name('pembayaran.sukses');
/*
|--------------------------------------------------------------------------
| Route fallback (404)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return view('errors.404');
})->name('fallback');
