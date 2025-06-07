<?php

use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\FaqController;
use App\Http\Controllers\Api\Admin\InvestorRelationController;
use App\Http\Controllers\Api\Admin\MitraController;
use App\Http\Controllers\Api\Admin\OurTeamController;
use App\Http\Controllers\Api\Admin\ProjectController;
use App\Http\Controllers\Api\Admin\ServiceCategoryController;
use App\Http\Controllers\Api\Admin\ServiceController;
use App\Http\Controllers\Api\Admin\SocialController;
use App\Http\Controllers\Api\Admin\WebSettingsController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Web\ApiWebSettingsController;
use App\Http\Controllers\Api\Web\LandingPageController;
use App\Http\Controllers\Api\Web\WebFaqController;
use App\Http\Controllers\Api\Web\WebMitraController;
use App\Http\Controllers\Api\Web\WebOurTeamController;
use App\Http\Controllers\Api\Web\WebProjectController;
use App\Http\Controllers\Api\Web\WebServiceController;
use App\Http\Controllers\Api\Web\WebSocialController;
use Illuminate\Support\Facades\Route;

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
    Route::post('/mitra/{id}', [MitraController::class, 'update']);
    Route::delete('/mitra/{id}', [MitraController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/our-team', [OurTeamController::class, 'index']);
    Route::get('/our-team/{id}', [OurTeamController::class, 'show']);
    Route::post('/our-team', [OurTeamController::class, 'store']);
    Route::post('/our-team/{id}', [OurTeamController::class, 'update']);
    Route::delete('/our-team/{id}', [OurTeamController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/social', [SocialController::class, 'show']);
    Route::post('/social', [SocialController::class, 'createOrUpdate']);
});

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{id}', [ProjectController::class, 'show']);
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::post('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/service-categories', [ServiceCategoryController::class, 'index']);
    Route::get('/service-categories/{id}', [ServiceCategoryController::class, 'show']);
    Route::post('/service-categories', [ServiceCategoryController::class, 'store']);
    Route::post('/service-categories/{id}', [ServiceCategoryController::class, 'update']);
    Route::delete('/service-categories/{id}', [ServiceCategoryController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/services/{id}', [ServiceController::class, 'show']);
    Route::post('/services', [ServiceController::class, 'store']);
    Route::post('/services/{id}', [ServiceController::class, 'update']);
    Route::delete('/services/{id}', [ServiceController::class, 'destroy']);
});

Route::get('/web/home', [LandingPageController::class, 'index']);
Route::get('/web/settings', [ApiWebSettingsController::class, 'index']);

Route::get('/faqs', [WebFaqController::class, 'index']);
Route::get('/web/social', [WebSocialController::class, 'index']);
Route::get('/web/projects', [WebProjectController::class, 'index']);
Route::get('/web/projects/{id}', [WebProjectController::class, 'show']);

Route::get('/web/services', [WebServiceController::class, 'index']);
Route::get('/web/services/{id}', [WebServiceController::class, 'show']);
Route::get('/web/our-team', [WebOurTeamController::class, 'index']);
Route::get('/web/our-team/{id}', [WebOurTeamController::class, 'show']);
Route::get('/web/mitras', [WebMitraController::class, 'index']);
Route::get('/web/mitras/{id}', [WebMitraController::class, 'show']);
