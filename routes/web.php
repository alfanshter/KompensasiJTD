<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\FingerCOntroller;
use App\Http\Controllers\KegiatanKompenController;
use App\Http\Controllers\KompenController;
use App\Http\Controllers\UsersController;
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

Route::get('/logout', [UsersController::class, 'logout'])->middleware('auth');
Route::get('/login', [UsersController::class, 'login_view'])->name('login')->middleware('guest');
Route::get('/', [UsersController::class, 'index'])->middleware('guest');
Route::get('/register', [UsersController::class, 'register_view_pelanggan'])->middleware('guest');
Route::post('/register', [UsersController::class, 'register'])->middleware('guest');
Route::post('/login', [UsersController::class, 'login']);

Route::get('/profil', [UsersController::class, 'profil'])->middleware('auth');

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

//Mahasiswa
Route::get('/mahasiswa', [UsersController::class, 'mahasiswa']);

//dosen
Route::get('/dosen', [DosenController::class, 'index']);
Route::post('/dosen', [DosenController::class, 'store']);
Route::post('/editdosen', [DosenController::class, 'edit']);
Route::get('/hapusdosen/{id?}', [DosenController::class, 'delete']);

//Kompen
Route::post('/editkompen', [KompenController::class, 'editkompen']);
Route::get('/kompenmahasiswa', [KompenController::class, 'kompenmahasiswa']);
Route::get('/kompenadmin', [KompenController::class, 'kompenadmin']);
Route::post('/kompenmahasiswa', [KompenController::class, 'ajukankompen']);
Route::post('/batalkompen', [KompenController::class, 'batalkompen']);
Route::post('/terimakompen', [KompenController::class, 'terimakompen']);
Route::post('/tolakkompen', [KompenController::class, 'tolakkompen']);
Route::post('/printpdf', [KompenController::class, 'printpdf']);

//Kegiatan Kompen
Route::get('/kegiatan', [KegiatanKompenController::class, 'index']);
Route::get('/hapuskegiatan/{id}', [KegiatanKompenController::class, 'delete']);
Route::post('/kegiatan', [KegiatanKompenController::class, 'store']);
Route::post('/editkegiatan', [KegiatanKompenController::class, 'update']);

//Fingerprint
Route::get('/request_finger', [FingerCOntroller::class, 'request_finger']);
Route::post('/post_fingerprint', [FingerCOntroller::class, 'post_fingerprint']);
Route::post('/request_absen', [FingerCOntroller::class, 'request_absen']);
Route::post('/request_absen_selesai', [FingerCOntroller::class, 'request_absen_selesai']);
