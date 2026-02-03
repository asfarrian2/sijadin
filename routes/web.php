<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubkegiatanController;
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
Route::get('/admin/sumberdana/subkegiatan/hapus{$id_subkegiatan}', [SubkegiatanController::class, 'hapus']);
