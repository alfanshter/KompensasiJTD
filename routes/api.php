<?php

use App\Http\Controllers\FingerCOntroller;
use App\Http\Controllers\KompenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/absen', [FingerCOntroller::class, 'absen']);
Route::post('/absen_selesai', [FingerCOntroller::class, 'absen_selesai']);
Route::post('/daftar_finger', [FingerCOntroller::class, 'daftar_finger']);

Route::get('/kompenmahasiswa', [KompenController::class, 'kompenmahasiswa_api']);