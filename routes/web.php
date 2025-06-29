<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexSiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KoreksiController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\QuisionerController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SoalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmateriController;
use App\Http\Controllers\ValidasiController;

// Auth


// Route::get('/', function () {
//     return redirect()->route('indexsiswa.index');
// });
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('auth.login.post');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Data kelas
Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');


Route::get('/kelas/{kelas}', [KelasController::class, 'kelassiswa'])->name('kelas.siswa');


Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');


//data siswa

Route::get('siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::post('siswa', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
Route::put('siswa/{siswa}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('siswa/{siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

// data nilai

Route::get('/nilai', [NilaiController::class, 'index'])->name('data.nilai');




// bank siswa
Route::get('/banksiswa', [BankController::class, 'index'])->name('data.banksiswa');



// data mapel

Route::get('mapel', [MapelController::class, 'index'])->name('mapel.index');
Route::post('mapel', [MapelController::class, 'store'])->name('mapel.store');
Route::put('mapel/{id}', [MapelController::class, 'update'])->name('mapel.update');
Route::delete('mapel/{id}', [MapelController::class, 'destroy'])->name('mapel.destroy');


// data materi
Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
Route::get('/materi/create', [MateriController::class, 'create'])->name('materi.create');
Route::post('/materi', [MateriController::class, 'store'])->name('materi.store');
Route::get('/materi/{id}/edit', [MateriController::class, 'edit'])->name('materi.edit');
Route::put('/materi/{id}', [MateriController::class, 'update'])->name('materi.update');
Route::delete('/materi/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');

//  sub-materi
Route::get('submateris', [SubmateriController::class, 'index'])->name('submateris.index');
Route::post('submateris', [SubmateriController::class, 'store'])->name('submateris.store');
Route::get('submateris/{id}', [SubmateriController::class, 'show'])->name('submateris.show');
Route::put('submateris/{id}', [SubmateriController::class, 'update'])->name('submateris.update');
Route::delete('submateris/{id}', [SubmateriController::class, 'destroy'])->name('submateris.destroy');
Route::get('submateris/{id}/details', [SubmateriController::class, 'details'])->name('submateris.details');
Route::delete('submateris/{submateriId}/details/{detailId}', [SubmateriController::class, 'deleteDetail'])->name('submateris.deleteDetail');
Route::get('submateri/by-materi/{id}', [SubmateriController::class, 'getByMateri']);



Route::get('/quiz', [QuisionerController::class, 'index'])->name('quiz.index');
Route::post('/quiz', [QuisionerController::class, 'store'])->name('quiz.store');

Route::put('/quiz/{id}', [QuisionerController::class, 'update'])->name('quiz.update');
Route::delete('/quiz/delete/{id}', [QuisionerController::class, 'destroy'])->name('quiz.destroy');


Route::get('/validasi', [ValidasiController::class, 'index'])->name('validasi.index');
Route::post('/validasi', [ValidasiController::class, 'store'])->name('validasi.store');
Route::delete('/validasi/{id}', [ValidasiController::class, 'destroy'])->name('validasi.destroy');
Route::put('/validasi/{id}', [ValidasiController::class, 'update'])->name('validasi.update');



Route::get('/siswa/index', [IndexSiswaController::class, 'index'])->name('indexsiswa.index');

Route::get('/siswa/soal', [IndexSiswaController::class, 'soal'])->name('indexsiswa.soal');


Route::get('/validasi/{validitas}', [ValidasiController::class, 'validator'])->name('validator');

Route::post('/update-data', [ValidasiController::class, 'updateData']);


Route::get('/', [AuthController::class, 'loginsiswa'])->name('index.siswa');





Route::get('/siswa/{qrcode}', [AuthController::class, 'postLoginsiswa'])->name('siswa.qrcode');
Route::post('/siswa/jawab-esai', [SoalController::class, 'jawabEsai'])->name('siswa.jawab.esai');



Route::get('/siswa/postest', [SoalController::class, 'index'])->name('siswa.postest');


Route::post('/siswa/postest/{submateri}/submit', [SoalController::class, 'submitPostest'])->name('siswa.postest.submit');

Route::get('/siswa/postest/{submateri}', [SoalController::class, 'postest'])
     ->name('siswa.postest.soal');


Route::get('/koreksi', [KoreksiController::class, 'index'])->name('koreksi.index');
Route::get('/koreksi/{siswa_id}/{submateris}/jawaban', [KoreksiController::class, 'show'])->name('koreksi.show');


Route::post('/koreksi/{siswa_id}/nilai', [KoreksiController::class, 'updateNilai'])->name('koreksi.nilai');
