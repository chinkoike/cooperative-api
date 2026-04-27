<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Public\CooperativeRequestController as PublicCooperativeRequestController;

// Public routes (ไม่ต้อง login)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Protected routes (ต้อง login)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Public user routes (role: public)
    Route::middleware('role:public')->prefix('public')->group(function () {
        Route::get('/requests',  [PublicCooperativeRequestController::class, 'index']);
        Route::post('/requests', [PublicCooperativeRequestController::class, 'store']);
    });

    // Staff routes (role: staff)
    Route::middleware('role:staff')->prefix('staff')->group(function () {
        // 
    });
});
