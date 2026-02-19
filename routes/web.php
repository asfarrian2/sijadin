<?php

use App\Http\Controllers\AkomodasinarsumController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KoderekeningController;
use App\Http\Controllers\NarsumController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PerjalanandinasController;
use App\Http\Controllers\SubkegiatanController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\UserController;
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

// Auth Proses
Route::get('/', [AuthController::class, 'view'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['middleware' => ['auth', 'role:admin']], function () {
// Dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'view']);

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
Route::post('/admin/sumberdana/tahun/dpa/rincian/sinkron', [AnggaranController::class, 'sinkron'])->name('a.sinkron');
Route::post('/admin/sumberdana/tahun/dpa/pptk/edit', [AnggaranController::class, 'edit']);
Route::post('/admin/sumberdana/tahun/dpa/rincian/edit', [AnggaranController::class, 'edit_r']);
Route::post('/admin/sumberdana/tahun/dpa/pptk/update', [AnggaranController::class, 'update'])->name('u.pptk');
Route::get('/admin/sumberdana/tahun/dpa/rincian/hapus/{id_anggaran}', [AnggaranController::class, 'hapus']);
Route::post('/admin/sumberdana/tahun/dpa/rincian/update', [AnggaranController::class, 'update_r'])->name('u.anggaran');

// Pegawai
Route::get('/admin/pegawai', [PegawaiController::class, 'view'])->name('pegawai');
Route::post('/admin/pegawai/store', [PegawaiController::class, 'store'])->name('a.pegawai');
Route::post('/admin/pegawai/edit', [PegawaiController::class, 'edit']);
Route::post('/admin/pegawai/update', [PegawaiController::class, 'update'])->name('u.pegawai');
Route::get('/admin/pegawai/hapus{id_pegawai}', [PegawaiController::class, 'hapus']);
Route::get('/admin/pegawai/status{id_pegawai}', [PegawaiController::class, 'status']);

// Perjadin
Route::get('/admin/perjadin/pegawai', [PerjalanandinasController::class, 'view_admin'])->name('perjadin');
Route::post('/admin/perjadin/pegawai/store', [PerjalanandinasController::class, 'store'])->name('a.perjadin');
Route::post('/admin/perjadin/pegawai/edit', [PerjalanandinasController::class, 'edit']);
Route::post('/admin/perjadin/pegawai/update', [PerjalanandinasController::class, 'update'])->name('u.perjadin');
Route::get('/admin/perjadin/pegawai/hapus{id_perjadin}', [PerjalanandinasController::class, 'hapus']);
Route::get('/admin/perjadin/pegawai/status{id_perjadin}', [PerjalanandinasController::class, 'status']);
Route::get('/get-subkegiatan/{idDpa}', [PerjalanandinasController::class, 'getSubkegiatan']);
Route::get('/get-koderekening/{idSubkegiatan}', [PerjalanandinasController::class, 'getKoderekening']);
Route::post('/admin/perjadin/pegawai/addpegawai', [PerjalanandinasController::class, 'add_pegawai']);
Route::post('/simpanperjadin-pegawai', [PerjalanandinasController::class, 'simpanPegawai']);
Route::post('/admin/perjadin/pegawai/listpegawai', [PerjalanandinasController::class, 'list_pegawai']);
Route::post('/perjadin/hapus-pegawai', [PerjalanandinasController::class, 'hapusPegawai']);
Route::get('/admin/perjadin/pegawai/spt/{id_perjadin}', [PerjalanandinasController::class, 'laporanSpt']);
Route::get('/admin/perjadin/pegawai/sppd/{id_rperjadin}', [PerjalanandinasController::class, 'laporanSppd']);

//Narsum
Route::get('/admin/perjadinfasilitator', [AkomodasinarsumController::class, 'view_admin'])->name('perfasilitator');
Route::post('/admin/perjadinfasilitator/store', [AkomodasinarsumController::class, 'store'])->name('a.perfasilitator');
Route::post('/admin/perjadinfasilitator/edit', [AkomodasinarsumController::class, 'edit']);
Route::post('/admin/perjadinfasilitator/update', [AkomodasinarsumController::class, 'update'])->name('u.perfasilitator');
Route::post('/admin/perjadinfasilitator/addnarsum', [AkomodasinarsumController::class, 'add_narsum']);
Route::post('/admin/perjadinfasilitator/simpannarsum', [AkomodasinarsumController::class, 'SimpanNarsum']);
Route::post('/admin/perjadinfasilitator/listnarsum', [AkomodasinarsumController::class, 'list_narsum']);


Route::get('/admin/perjadinfasilitator/narasumber', [NarsumController::class, 'view'])->name('narsum');
Route::post('/admin/perjadinfasilitator/narasumber/store', [NarsumController::class, 'store'])->name('a.narsum');
Route::post('/admin/perjadinfasilitator/narasumber/edit', [NarsumController::class, 'edit']);
Route::post('/admin/perjadinfasilitator/narasumber/update', [NarsumController::class, 'update'])->name('u.narsum');
Route::get('/admin/perjadinfasilitator/narasumber/status{id_pegawai}', [NarsumController::class, 'status']);
Route::get('/admin/perjadinfasilitator/narasumber/hapus{id_perjadin}', [NarsumController::class, 'hapus']);

// User
Route::get('/admin/users/admin', [UserController::class, 'view_admin'])->name('admin');
Route::get('/admin/users/kpa', [UserController::class, 'view_kpa'])->name('kpa');
Route::post('/admin/users/store', [UserController::class, 'store'])->name('a.admin');
Route::post('/admin/users/edit', [UserController::class, 'edit']);
Route::post('/admin/users/update', [UserController::class, 'update'])->name('u.admin');
Route::get('/admin/users/hapus{id}', [UserController::class, 'hapus']);
Route::get('/admin/users/status{id}', [UserController::class, 'status']);

});

Route::group(['middleware' => ['auth', 'role:kpa']], function () {
// Dashboard
Route::get('/kpa/dashboard', [DashboardController::class, 'kpa'])->name('dashboard.kpa');

});