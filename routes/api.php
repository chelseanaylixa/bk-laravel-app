<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasusApiController;
use App\Http\Controllers\TataTertibApiController;
use App\Http\Controllers\SurveiController;
use App\Http\Controllers\JurusanController;

// Get all siswa with poin
Route::get('/siswa-list', [KasusApiController::class, 'getSiswaWithPoin']);

// Get all kasus
Route::get('/kasus', [KasusApiController::class, 'getAllKasus']);

// Get kasus for specific siswa
Route::get('/kasus/siswa/{siswaId}', [KasusApiController::class, 'getKasusBySiswa']);

// Create kasus (admin/guru_bk only)
Route::post('/kasus', [KasusApiController::class, 'store']);

// Update kasus
Route::put('/kasus/{kasusId}', [KasusApiController::class, 'update']);

// Delete kasus
Route::delete('/kasus/{kasusId}', [KasusApiController::class, 'destroy']);

// Tata Tertib Routes
Route::get('/tata-tertib', [TataTertibApiController::class, 'index']);
Route::post('/tata-tertib', [TataTertibApiController::class, 'store']);
Route::put('/tata-tertib/{id}', [TataTertibApiController::class, 'update']);
Route::delete('/tata-tertib/{id}', [TataTertibApiController::class, 'destroy']);

// Survei Routes
Route::delete('/survei/{id}', [SurveiController::class, 'destroy']);
