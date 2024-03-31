<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StationController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(ReviewController::class)->group(function () {
    Route::get('reviews', 'index');
    Route::get('reviews/{id}','show');
    Route::post('reviews', 'store');
    Route::put('reviews/{id}', 'update');
    Route::delete('reviews/{id}', 'destroy');
});


Route::controller(StationController::class)->group(function () {
    Route::get('stations', 'index');
    Route::get('stations/{id}','show');
    Route::post('stations', 'store');
    Route::put('stations/{id}', 'update');
    Route::delete('stations/{id}', 'destroy');
    Route::get('stations/{id}/location', 'getLocation');
});

Route::get('testing', function () {
    return "this is a test api";
});

Route::post('/addchat', [ChatController::class, 'addchat']);
Route::get('/getChats/{user_id}/{recipient_id}', [ChatController::class, 'getChats']);
