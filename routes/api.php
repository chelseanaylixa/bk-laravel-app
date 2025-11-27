<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasusApiController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
// return $request->user();
// });

// API Routes untuk Kasus (Protected dengan auth)
// Route::middleware('auth:sanctum')->group(function () {
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
// });
