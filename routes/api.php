<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\UserApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Register
Route::post('register', [ApiController::class, 'register']);

Route::middleware('auth:sanctum')->group(function(){
    // Login
    Route::get('check', [ApiController::class, 'check']);
    Route::post('login', [ApiController::class, 'login']);
    Route::get('logout', [ApiController::class, 'logout']);

    // User
    Route::get('user/get_all', [UserApiController::class, 'getAll']);
    Route::post('user/get', [UserApiController::class, 'get']);
    Route::post('user/edit', [UserApiController::class, 'edit']);
    Route::post('user/delete', [UserApiController::class, 'delete']);
});
