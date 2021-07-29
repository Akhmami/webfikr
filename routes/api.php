<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CallbackController;

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

Route::middleware('auth:sanctum')->group( function () {
    Route::post('/me', [AuthController::class, 'me']);
});
