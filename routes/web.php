<?php

use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KoderekeningController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SubkegiatanController;
use App\Http\Controllers\TahunController;
use App\Models\Subkegiatan;
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

// Home
Route::get('/', [DashboardController::class, 'view']);

// Sub Kegiatan
Route::get('/admin/sumberdana/subkegiatan', [SubkegiatanController::class, 'view'])->name('subkegiatan');
Route::post('/admin/sumberdana/subkegiatan/store', [SubkegiatanController::class, 'store'])->name('a.subkegiatan');
Route::post('/admin/sumberdana/subkegiatan/edit', [SubkegiatanController::class, 'edit']);
Route::post('/admin/sumberdana/subkegiatan/update', [SubkegiatanController::class, 'update'])->name('u.subkegiatan');
Route::get('/admin/sumberdana/subkegiatan/hapus{id_subkegiatan}', [SubkegiatanController::class, 'hapus']);
Route::get('/admin/sumberdana/subkegiatan/status{id_subkegiatan}', [SubkegiatanController::class, 'status']);

// Kode Rekening
Route::get('/admin/sumberdana/koderekening', [KoderekeningController::class, 'view'])->name('koderekening');
Route::post('/admin/sumberdana/koderekening/store', [KoderekeningController::class, 'store'])->name('a.koderekening');
Route::post('/admin/sumberdana/koderekening/edit', [KoderekeningController::class, 'edit']);
Route::post('/admin/sumberdana/koderekening/update', [KoderekeningController::class, 'update'])->name('u.koderekening');
Route::get('/admin/sumberdana/koderekening/hapus{id_rekening}', [KoderekeningController::class, 'hapus']);
Route::get('/admin/sumberdana/koderekening/status{id_rekening}', [KoderekeningController::class, 'status']);

// Tahun
Route::get('/admin/sumberdana/tahun', [TahunController::class, 'view'])->name('tahun');
Route::post('/admin/sumberdana/tahun/store', [TahunController::class, 'store'])->name('a.tahun');
Route::post('/admin/sumberdana/tahun/edit', [TahunController::class, 'edit']);
Route::post('/admin/sumberdana/tahun/update', [TahunController::class, 'update'])->name('u.tahun');
Route::get('/admin/sumberdana/tahun/hapus{id_tahun}', [TahunController::class, 'hapus']);
Route::get('/admin/sumberdana/tahun/status{id_tahun}', [TahunController::class, 'status']);
Route::post('/admin/sumberdana/tahun/dpa', [TahunController::class, 'add_dpa']);
Route::post('/admin/sumberdana/tahun/dpa/store', [TahunController::class, 'store_dpa'])->name('a.dpa');
Route::post('/admin/sumberdana/tahun/dpa/edit', [TahunController::class, 'edit_dpa']);
Route::get('/admin/sumberdana/tahun/dpa/hapus{id_dpa}', [TahunController::class, 'hapus_dpa']);
Route::post('/admin/sumberdana/tahun/dpa/update', [TahunController::class, 'update_dpa'])->name('u.dpa');

// Anggaran
Route::get('/admin/sumberdana/tahun/dpa/rincian{id_dpa}', [AnggaranController::class, 'view']);
Route::post('/admin/sumberdana/tahun/dpa/rincian/store', [AnggaranController::class, 'store'])->name('a.anggaran');
Route::post('/admin/sumberdana/tahun/dpa/rincian/edit', [AnggaranController::class, 'edit']);
Route::get('/admin/sumberdana/tahun/dpa/rincian/hapus{id_dpa}', [AnggaranController::class, 'hapus']);
Route::post('/admin/sumberdana/tahun/dpa/rincian/update', [AnggaranController::class, 'update_dpa'])->name('u.anggaran');

// Pegawai
Route::get('/admin/pegawai', [PegawaiController::class, 'view'])->name('pegawai');
Route::post('/admin/pegawai/store', [PegawaiController::class, 'store'])->name('a.pegawai');
Route::post('/admin/pegawai/edit', [PegawaiController::class, 'edit']);
Route::post('/admin/pegawai/update', [PegawaiController::class, 'update'])->name('u.pegawai');
Route::get('/admin/pegawai/hapus{id_pegawai}', [PegawaiController::class, 'hapus']);
Route::get('/admin/pegawai/status{id_pegawai}', [PegawaiController::class, 'status']);

