<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\RadcheckController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Models\Radcheck;

Route::prefix('radcheck')->name('radcheck.')->group(function () {
    // Rute utama Radcheck
    Route::get('/', [RadcheckController::class, 'index'])->name('index'); // Menampilkan daftar pengguna PPPoE
    Route::get('/search', [RadcheckController::class, 'search'])->name('search'); // Pencarian pengguna
    Route::post('/store', [RadcheckController::class, 'store'])->name('store'); // Menyimpan pengguna baru
    Route::get('/edit/{id}', [RadcheckController::class, 'edit'])->name('edit'); // Menampilkan form edit pengguna
    Route::post('/update/{id}', [RadcheckController::class, 'update'])->name('update'); // Memperbarui pengguna
    Route::delete('/{id}', [RadcheckController::class, 'destroy'])->name('destroy'); // Menghapus pengguna
    Route::post('{id}/update_status', [RadcheckController::class, 'update_status'])->name('update_status'); // Memperbarui status pengguna
    Route::patch('{id}/used', [RadcheckController::class, 'markAsUsed'])->name('markAsUsed'); // Menandai pengguna sebagai digunakan
    Route::post('/radcheck/{id}/change-password', [RadcheckController::class, 'changePassword'])->name('change_password'); // Mengubah password pengguna

    Route::get('/dashboard', [RadcheckController::class, 'dashboard'])->name('dashboard');
    Route::get('/tambah_user', [RadcheckController::class, 'create'])->name('create_user');
    
    // Rute untuk PPPoE aktif dan tidak aktif
    Route::get('/active', [RadcheckController::class, 'active'])->name('active'); // Halaman PPPoE aktif
    Route::get('/inactive', [RadcheckController::class, 'inactive'])->name('inactive'); // Halaman PPPoE non-aktif

    // Rute untuk menampilkan form login
    Route::get('/login', [LoginController::class, 'formlogin'])->name('login_form');

    // Rute untuk memproses form login
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    
    // Rute untuk log out
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Menampilkan pengguna user login
    Route::get('/biodata', [LoginController::class, 'ShowBiodata'])->middleware('auth')->name('biodata');

    // Random password
    Route::post('/store-random', [RadcheckController::class, 'RandomPassword'])->name('storeRandom');

    // Rute baru: Disable user
    Route::patch('{id}/disable', [RadcheckController::class, 'disableUser'])->name('disable'); // Menonaktifkan pengguna

    // Route untuk menampilkan data tambahan dari database kedua
    Route::get('/additional', [RadcheckController::class, 'getAdditionalData'])->name('additional');

    // Route untuk menampilkan data gabungan dari database utama dan kedua
    Route::get('/combined', [RadcheckController::class, 'combineUserData'])->name('combined');

    // Route untuk menyimpan data ke database kedua
    Route::post('/store-secondary', [RadcheckController::class, 'storeToSecondary'])->name('store.secondary');

    // Route untuk menampilkan admin aktif
    Route::get('/active', [AdminController::class, 'active'])->name('active'); // Menampilkan admin yang aktif

    // Route lainnya
    Route::get('/admin', [AdminController::class, 'create'])->name('admin'); // Form untuk create admin
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store'); // Menyimpan admin baru

    //view editadmin
    Route::get('/radcheck/editadmin/{id}', [AdminController::class, 'editAdmin'])->name('radcheck.editadmin');

    // Route to handle the form submission for updating the admin
    Route::put('/update-admin/{id}', [AdminController::class, 'updateAdmin'])->name('update-admin');

});
