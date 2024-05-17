<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::resource('user', App\Http\Controllers\UserController::class)->middleware('adminOrOwnUser');
Route::resource('karyawan', App\Http\Controllers\KaryawanController::class);
Route::resource('tunjangan', App\Http\Controllers\TunjanganController::class);
Route::resource('potongan', App\Http\Controllers\PotonganController::class);
Route::resource('honormengajar', App\Http\Controllers\HonorMengajarController::class);
Route::resource('akun', App\Http\Controllers\AkunController::class);
Route::resource('jurnal', App\Http\Controllers\JurnalController::class);
Route::resource('gaji', App\Http\Controllers\GajiController::class);

Route::get('/laporan', [App\Http\Controllers\LaporanGajiController::class, 'index'])->name('laporan.gaji');
Route::post('/laporan', [App\Http\Controllers\LaporanGajiController::class, 'generateReport'])->name('laporan.gaji.generate');
Route::post('/laporan-pdf', [App\Http\Controllers\LaporanGajiController::class, 'generatePDF'])->name('laporan.gaji.pdf');

Route::get('/laporanjurnal', [App\Http\Controllers\LaporanJurnalController::class, 'index'])->name('laporan.jurnal');
Route::post('/laporanjurnal', [App\Http\Controllers\LaporanJurnalController::class, 'generateReport'])->name('laporan.jurnal.generate');
Route::post('/laporanjurnal-pdf', [App\Http\Controllers\LaporanJurnalController::class, 'generatePDF'])->name('laporan.jurnal.pdf');
