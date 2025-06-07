<?php

use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\FaqController;
use App\Http\Controllers\Api\Admin\InvestorRelationController;
use App\Http\Controllers\Api\Admin\MitraController;
use App\Http\Controllers\Api\Admin\OurTeamController;
use App\Http\Controllers\Api\Admin\SocialController;
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

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/mitra', [MitraController::class, 'index']);
    Route::get('/mitra/{id}', [MitraController::class, 'show']);
    Route::post('/mitra', [MitraController::class, 'store']);
    Route::post('/mitra/{id}', [MitraController::class, 'update']); // pakai POST jika frontend sulit pakai PUT
    Route::delete('/mitra/{id}', [MitraController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/our-team', [OurTeamController::class, 'index']);
    Route::get('/our-team/{id}', [OurTeamController::class, 'show']);
    Route::post('/our-team', [OurTeamController::class, 'store']);
    Route::post('/our-team/{id}', [OurTeamController::class, 'update']); // gunakan POST jika PUT sulit di frontend
    Route::delete('/our-team/{id}', [OurTeamController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/social', [SocialController::class, 'show']);
    Route::post('/social', [SocialController::class, 'createOrUpdate']);
});

Route::get('/faqs', [WebFaqController::class, 'index']);