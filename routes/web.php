<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\CripsController;
use App\Http\Controllers\HitungController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\Rel_AlternatifController;
use App\Http\Controllers\Rel_CripsController;
use App\Http\Controllers\Rel_KriteriaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KonfigurasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'level'])->group(
    function () {
        Route::get('/home', [HomeController::class, 'show'])->name('home')->middleware('auth');
        Route::get('/', [HomeController::class, 'show'])->name('home')->middleware('auth');

        Route::get('/alternatif/cetak', [AlternatifController::class, 'cetak'])->name('alternatif.cetak');
        Route::get('/alternatif/detail', [AlternatifController::class, 'detail'])->name('alternatif.detail');
        Route::post('/alternatif/detail/update', [AlternatifController::class, 'detail_update'])->name('alternatif.detail.update');
        Route::resource('/alternatif', AlternatifController::class);
        Route::get('/kriteria/cetak', [KriteriaController::class, 'cetak'])->name('kriteria.cetak');
        Route::resource('/kriteria', KriteriaController::class);
        Route::get('/crips/cetak', [CripsController::class, 'cetak'])->name('crips.cetak');
        Route::resource('/crips', CripsController::class);
        Route::get('/rel_alternatif/cetak', [Rel_AlternatifController::class, 'cetak'])->name('rel_alternatif.cetak');
        Route::resource('/rel_alternatif', Rel_AlternatifController::class);
        Route::get('/hitung', [HitungController::class, 'index'])->name('hitung.index');
        Route::get('/hitung/cetak', [HitungController::class, 'cetak'])->name('hitung.cetak');

        Route::get('/rel_kriteria', [Rel_KriteriaController::class, 'index'])->name('rel_kriteria.index');
        Route::post('/rel_kriteria', [Rel_KriteriaController::class, 'simpan'])->name('rel_kriteria.simpan');
        Route::get('/rel_crips', [Rel_CripsController::class, 'index'])->name('rel_crips.index');
        Route::post('/rel_crips', [Rel_CripsController::class, 'simpan'])->name('rel_crips.simpan');

        Route::get('/user/profil', [UserController::class, 'profil'])->name('user.profil');
        Route::post('/user/profil', [UserController::class, 'profilUpdate'])->name('user.profil.update');
        Route::get('/user/password', [UserController::class, 'password'])->name('user.password');
        Route::post('/user/password', [UserController::class, 'passwordUpdate'])->name('user.password.update');
        Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');
        Route::resource('user', UserController::class);

        // Route::get('/konfigurasi', [KonfigurasiController::class, 'index'])->name('konfigurasi.index');

        Route::resource('/konfigurasi', KonfigurasiController::class);
        Route::get('/jadwal', [HitungController::class, 'jadwalindex'])->name('jadwal.index');
        // Route::get('/jadwal',function(){
        //     $data['title'] = 'Jadwal - Periode Perubahan';
        //     return view('jadwal.index',$data);
        // })->name('jadwal.index');
    }
);
Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::post('/login', [UserController::class, 'loginAction'])->name('login.action');
Route::get('/message', [HomeController::class, 'message'])->name('message');
