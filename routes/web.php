<?php

use App\Events\HelloEvent;
use App\Models\Antrian;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\User\AntrianController as UserAntrianController;
use App\Http\Controllers\Admin\AntrianController as AdminAntrianController;
use App\Http\Controllers\Admin\PegawaiController as AdminPegawaiController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\JadwalDokterController;
use App\Models\Admin;

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
Route::get('/', [AdminAuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('authenticate', [AdminAuthController::class, 'authenticate'])->name('admin-authenticate');
Route::post('register', [AdminAuthController::class, 'register'])->name('register');
Route::get('logout/user', [AdminAuthController::class, 'logoutUser'])->name('user-logout')->middleware('auth:user');




Route::group(['middleware' =>  'auth:admin'], function () {
    Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin-logout');

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('admin/profile/{admin}', [AdminAuthController::class, 'edit'])->name('admin-profile.edit');
    Route::put('admin/profile/update/{admin}', [AdminAuthController::class, 'update'])->name('admin-profile.update');

    // PEGAWAI
    Route::get('pegawai', [AdminPegawaiController::class, 'index'])->name('pegawai-index');
    Route::post('pegawai/add', [AdminPegawaiController::class, 'store'])->name('pegawai-store');
    Route::get('pegawai/edit/{pegawai}', [AdminPegawaiController::class, 'edit'])->name('pegawai-edit');
    Route::put('pegawai/update/{pegawai}', [AdminPegawaiController::class, 'update'])->name('pegawai-update');
    Route::delete('pegawai/delete/{pegawai}', [AdminPegawaiController::class, 'delete'])->name('pegawai-delete');


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
    Route::put('antrian/skip/{antrian:jenis_antrian}', [AdminAntrianController::class, 'skip'])->name('admin-antrian.skip');
    Route::put('antrian/update/{antrian:jenis_antrian}', [AdminAntrianController::class, 'status'])->name('admin-antrian.updateStatus');


    // dokter
    Route::get('dokter', [DokterController::class, 'index'])->name('admin-dokter.index');
    Route::post('dokter/add', [DokterController::class, 'store'])->name('admin-dokter.store');
    Route::get('dokter/edit/{dokter}', [DokterController::class, 'edit'])->name('admin-dokter.edit');
    Route::put('dokter/update/{dokter}', [DokterController::class, 'update'])->name('admin-dokter.update');
    Route::delete('dokter/delete/{dokter}', [DokterController::class, 'delete'])->name('admin-dokter.delete');


    // Jadwal
    Route::get('jadwal', [JadwalDokterController::class, 'index'])->name('admin-jadwal.index');
    Route::post('jadwal/add', [JadwalDokterController::class, 'store'])->name('admin-jadwal.store');
    Route::get('jadwal/edit/{jadwal}', [JadwalDokterController::class, 'edit'])->name('admin-jadwal.edit');
    Route::put('jadwal/update/{jadwal}', [JadwalDokterController::class, 'update'])->name('admin-jadwal.update');
    Route::delete('jadwal/delete/{jadwal}', [JadwalDokterController::class, 'delete'])->name('admin-jadwal.delete');


    // tomboltutup
    // Route::post('/admin/tutup-antrian/{jenis}', [AdminAntrianController::class, 'tutupAntrian'])->name('admin.tutup-antrian');
    Route::post('/admin/tutup-antrian/{jenisAntrian}', [AdminAntrianController::class, 'tutupAntrian'])->name('admin.tutup-antrian');
    Route::post('/admin/buka-antrian/{jenisAntrian}', [AdminAntrianController::class, 'bukaAntrian'])->name('admin.buka-antrian');
});
Route::group(['middleware' =>  'auth:user'], function () {
    Route::get('antrian', [UserAntrianController::class, 'index'])->name('user-antrian');
    Route::get('antrian/show/{jenis}', [UserAntrianController::class, 'showAntrian'])->name('user-antrian.show');
    Route::post('antrian/add/{jenis_antrian}', [UserAntrianController::class, 'store'])->name('user-antrian.store');


    Route::get('user/profile/{user}', [UserController::class, 'edit'])->name('profile');
    Route::put('user/profile/update/{user}', [UserController::class, 'update'])->name('profile-update');
});

Route::get('register', [UserController::class, 'showRegister'])->name('user-register')->middleware('guest');
Route::post('register', [UserController::class, 'store'])->name('user-register.store');
