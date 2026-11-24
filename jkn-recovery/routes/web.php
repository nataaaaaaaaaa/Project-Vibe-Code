<?php

use App\Http\Controllers\AntreanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AntreanController::class, 'beranda'])->name('beranda');
Route::get('/skenario/{nama}', [AntreanController::class, 'skenario'])->name('skenario');
Route::get('/antrean', [AntreanController::class, 'form'])->name('antrean.form');
Route::post('/antrean', [AntreanController::class, 'daftar'])->name('antrean.daftar');
Route::get('/antrean/proses', [AntreanController::class, 'proses'])->name('antrean.proses');
Route::post('/antrean/kirim', [AntreanController::class, 'kirim'])->name('antrean.kirim');
Route::get('/antrean/hasil/{status}', [AntreanController::class, 'hasil'])->name('antrean.hasil');
Route::get('/antrean/manual', [AntreanController::class, 'manual'])->name('antrean.manual');
Route::get('/reset', [AntreanController::class, 'reset'])->name('reset');