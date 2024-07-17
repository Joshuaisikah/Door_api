<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfficeController;

// Authentication routes
Route::post('/register', [AuthController::class, "register"]);
Route::post('/login', [AuthController::class, "login"]);

// Protected route to get the authenticated user's details
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Grouping office-related routes under Sanctum's authentication middleware
Route::middleware('auth:sanctum')->group(function () {
    // Updated routes without the {officeId} parameter
    Route::post('/office/toggle-light', [OfficeController::class, 'toggleLight']);
    Route::post('/office/toggle-door', [OfficeController::class, 'toggleDoor']);
    Route::get('/office/states', [OfficeController::class, 'checkStates']);
});
