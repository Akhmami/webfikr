<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CallbackController;
use App\Http\Controllers\Api\SurveyController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/{slug}', function () {
    return response()->json('Not found', 404);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/callback/payments', [CallbackController::class, 'index']);
// Route::post('/dev/callback/payments', [CallbackController::class, 'development']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::middleware('role:super-admin|admin')->group(function () {
        Route::post('/user', [UserController::class, 'user']);
        Route::post('/user/psb', [UserController::class, 'psb']);
        Route::post('/survey/psb', [SurveyController::class, 'psb']);
        Route::get('/user/administrasi', [UserController::class, 'administrasi']);
    });
});
