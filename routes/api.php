<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasusApiController;
use App\Http\Controllers\TataTertibApiController;
use App\Http\Controllers\SurveiController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\UserController;

// Get all siswa with poin
Route::get('/siswa-list', [KasusApiController::class, 'getSiswaWithPoin']);

// Get all kasus
Route::get('/kasus', [KasusApiController::class, 'getAllKasus']);

// Get kasus for specific siswa
Route::get('/kasus/siswa/{siswaId}', [KasusApiController::class, 'getKasusBySiswa']);

// Get kasus detail untuk modal (dengan pelanggaran lengkap)
Route::get('/siswa/{siswaId}/kasus', function ($siswaId) {
    $kasus = \App\Models\Kasus::where('siswa_id', $siswaId)
        ->with('pelanggaran')
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json($kasus);
});

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

// User Routes (Admin Only)
Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'getAllUsers']);
    Route::put('/users/{id}', [UserController::class, 'updateUserRole']);
});

// Check current user status (for waiting approval page)
Route::middleware('auth')->get('/user-status', function (Request $request) {
    // Force refresh dari database
    $user = \App\Models\User::find($request->user()->id);

    return response()->json([
        'role' => $user->role,
        'status' => $user->status ?? 'approved',
        'email' => $user->email,
        'name' => $user->name
    ]);
});
