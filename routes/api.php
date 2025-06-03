<?php

use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\FaqController;
use App\Http\Controllers\Api\Admin\InvestorRelationController;
use App\Http\Controllers\Api\Admin\WebSettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Web\WebFaqController;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});


Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    // Faq routes
    Route::get('/faqs', [FaqController::class, 'index']);
    Route::get('/faqs/{id}', [FaqController::class, 'show']);
    Route::post('/faqs', [FaqController::class, 'store']);
    Route::put('/faqs/{id}', [FaqController::class, 'update']);
    Route::delete('/faqs/{id}', [FaqController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/web-settings', [WebSettingsController::class, 'index']);
    Route::post('/web-settings', [WebSettingsController::class, 'store']);
    Route::put('/web-settings/{id}', [WebSettingsController::class, 'update']);
    Route::delete('/web-settings/{id}', [WebSettingsController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/investor-relations', [InvestorRelationController::class, 'index']);
    Route::get('/investor-relations/{id}', [InvestorRelationController::class, 'show']);
    Route::post('/investor-relations', [InvestorRelationController::class, 'store']);
    Route::put('/investor-relations/{id}', [InvestorRelationController::class, 'update']);
    Route::delete('/investor-relations/{id}', [InvestorRelationController::class, 'destroy']);
});

Route::get('/faqs', [WebFaqController::class, 'index']);