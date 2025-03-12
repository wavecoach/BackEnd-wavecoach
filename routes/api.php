<?php

use App\Http\Controllers\API\AbsensiController;
use App\Http\Controllers\API\AssessmentController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\InventoryController;
use App\Http\Controllers\API\InventoryManagementController;
use App\Models\Assessment;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('absensi-coach', [AbsensiController::class, 'coachAbsent']);
    Route::post('absensi-student', [AbsensiController::class, 'studentAbsent']);

    Route::get('schedule', [HomeController::class, 'getSchedule']);
    Route::get('schedule/{id}', [HomeController::class, 'getDetailSchedule']);
    Route::post('reschedule', [HomeController::class, 'requestReschedule']);

    Route::get('daftarinventory', [InventoryManagementController::class, 'index']);
    Route::post('request-loan', [InventoryController::class, 'requestLoan']);
    Route::patch('update-loan-status/{requestId}', [InventoryController::class, 'updateLoanStatus']);
    Route::post('return/{landingId}', [InventoryController::class, 'returnInventory']);

    Route::get('assesment-category', [AssessmentController::class, 'getCategory']);
    Route::get('assessment-aspect/{id}', [AssessmentController::class, 'getAspect']);
    Route::post('post-assessment', [AssessmentController::class, 'postAssessment']);
    Route::get('history-assessment', [AssessmentController::class, 'getHistory']);
    Route::get('history-assessment/{id}', [AssessmentController::class, 'getDetailHistory']);
});
