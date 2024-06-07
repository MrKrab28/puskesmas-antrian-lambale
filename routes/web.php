<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PegawaiController as AdminPegawaiController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AntrianController as AdminAntrianController;
use App\Http\Controllers\User\AntrianController as UserAntrianController;
use App\Models\Antrian;
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

// Route::get('/', function () {
//     return view('user.welcome');
// });

// Admin Auth
Route::get('/', [AdminAuthController::class, 'login'])->name('login');
Route::post('authenticate', [AdminAuthController::class, 'authenticate'])->name('admin-authenticate');
Route::post('register', [AdminAuthController::class, 'register'])->name('register');

Route::group(['middleware' =>  'auth:admin'], function () {
    Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin-logout');

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // PEGAWAI
    Route::get('pegawai', [AdminPegawaiController::class, 'index'])->name('pegawai-index');
    Route::post('pegawai/add', [AdminPegawaiController::class, 'store'])->name('pegawai-store');
    Route::get('pegawai/edit/{pegawai}', [AdminPegawaiController::class, 'edit'])->name('pegawai-edit');
    Route::put('pegawai/update/{pegawai}', [AdminPegawaiController::class, 'update'])->name('pegawai-update');
    Route::delete('pegawai/delete/{pegawai}', [AdminPegawaiController::class, 'delete'])->name('pegawai-delete');
});

// USER/PASIEN
Route::get('user', [AdminUserController::class, 'index'])->name('user-index');
Route::post('user/store', [AdminUserController::class, 'store'])->name('user-store');
Route::get('user/edit/{user}', [AdminUserController::class, 'edit'])->name('user-edit');
Route::put('user/update/{user}', [AdminUserController::class, 'update'])->name('user-update');
Route::delete('user/delete/{user}', [AdminUserController::class, 'delete'])->name('user-delete');


// Admin antrian
Route::get('admin-antrian', [AdminAntrianController::class, 'index'])->name('admin-antrian');
route::post('add/admin-antrian', [AdminAntrianController::class, 'store'])->name('admin-antrian.store');
// Route::put('antrian/{antrian}/ubah-status', [AdminAntrianController::class, 'status'])->name('ubah-status-antrian');
Route::put('antrian/update/{antrian:jenis_antrian}', [AdminAntrianController::class, 'status'])->name('admin-antrian.updateStatus');

Route::group(['middleware' =>  'auth:user'], function () {
Route::get('antrian', [UserAntrianController::class, 'index'])->name('user-antrian');
});
