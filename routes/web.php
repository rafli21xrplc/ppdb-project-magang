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


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('pendaftaran', [\App\Http\Controllers\siswaController::class, 'index'])->name('pendaftaran');
Route::post('pendaftaran-store', [\App\Http\Controllers\siswaController::class, 'store'])->name('store');

Route::get('cek-status', [\App\Http\Controllers\siswaController::class, 'cekStatus'])->name('cekStatus');
Route::get('pengumuman', [\App\Http\Controllers\siswaController::class, 'pengumuman'])->name('pengumuman');

Route::get('faq', function () {
    return view('faq');
})->name('faq');
