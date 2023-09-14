<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(function () {
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
});

Route::prefix('/my-goal/v1')->group(function () {
    Route::prefix('/goals')->group(function () {
        Route::get('/{term_id}', [App\Http\Controllers\GoalApi::class, 'index']);
        Route::put('/{term_id}', [App\Http\Controllers\GoalApi::class, 'update']);
    });

    Route::prefix('/meetings')->group(function () {
        Route::get('/', [App\Http\Controllers\MeetingApi::class, 'index']);
        Route::get('/{id}/base', [App\Http\Controllers\MeetingApi::class, 'base']);
        Route::get('/{id}/detail', [App\Http\Controllers\MeetingApi::class, 'detail']);
        Route::post('/', [App\Http\Controllers\MeetingApi::class, 'store']);
        Route::put('/', [App\Http\Controllers\MeetingApi::class, 'update']);
    });

    Route::prefix('/users')->group(function () {
        Route::get('/', [App\Http\Controllers\UserApi::class, 'index']);
    });
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
