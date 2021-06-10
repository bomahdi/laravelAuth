<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'user'

], function ($router) {
    Route::post('/', [UserController::class, 'create']);
    Route::get('/', [UserController::class, 'read']);
    Route::put('/', [UserController::class, 'update']);
    Route::delete('/', [UserController::class, 'delete']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'post'

], function ($router) {
    Route::post('/', [PostController::class, 'create']);
    Route::get('/', [PostController::class, 'read']);
    Route::put('/', [PostController::class, 'update']);
    Route::delete('/', [PostController::class, 'delete']);
});
