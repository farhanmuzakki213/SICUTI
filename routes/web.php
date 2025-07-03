<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\PegawaiController;
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
// Rute untuk halaman login
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/user/logout', [AdminController::class, 'destroy'])->name('user.logout');

// Rute untuk Manager
Route::group(['middleware' => ['role:manager']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/karyawan', [PegawaiController::class, 'index'])->name('karyawan');
    Route::post('/karyawan/store', [PegawaiController::class, 'store'])->name('karyawan.store');
    Route::get('/karyawan/create', [PegawaiController::class, 'create'])->name('karyawan.create');
    Route::get('/karyawan/edit/{id}', [PegawaiController::class, 'edit'])->name('karyawan.edit');
    Route::put('/karyawan/update/{id}', [PegawaiController::class, 'update'])->name('karyawan.update');
    Route::delete('/karyawan/delete/{id}', [PegawaiController::class, 'delete'])->name('karyawan.delete');
});

// Rute untuk Karyawan, Assistant, Staff, dan Manager
Route::group(['middleware' => ['role:manager|assistant|staff|employee']], function () {
    Route::get('/dataCuti', [CutiController::class, 'index'])->name('cuti');

    // Rute untuk Assistant, Staff, dan Manager
    Route::group(['middleware' => ['role:manager|assistant|staff']], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::put('/cuti/update/{id}', [CutiController::class, 'update'])->name('cuti.update');
    });
    // Rute khusus untuk Karyawan
    Route::group(['middleware' => ['role:employee']], function () {
        Route::get('/pengajuanCuti/create', [CutiController::class, 'create'])->name('cuti.create');
        Route::delete('/cuti/delete/{id}', [CutiController::class, 'delete'])->name('cuti.delete');
        Route::post('/cuti/store', [CutiController::class, 'store'])->name('cuti.store');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
