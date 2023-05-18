<?php

use App\Http\Controllers\DashboardController;
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

//Kompen
Route::post('/editkompen', [KompenController::class, 'editkompen']);

//Kompen
Route::get('/kegiatan', [KegiatanKompenController::class, 'index']);
Route::get('/hapuskegiatan/{id}', [KegiatanKompenController::class, 'delete']);
Route::post('/kegiatan', [KegiatanKompenController::class, 'store']);
Route::post('/editkegiatan', [KegiatanKompenController::class, 'update']);

