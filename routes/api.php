<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\CoinRequestController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\TicketController;
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
    Route::get('reviews/{id}', 'show');
    Route::post('reviews', 'store');
    Route::put('reviews/{id}', 'update');
    Route::delete('reviews/{id}', 'destroy');
});


Route::controller(StationController::class)->group(function () {
    Route::get('stations', 'index');
    Route::get('stations/{id}', 'show');
    Route::post('stations', 'store');
    Route::put('stations/{id}', 'update');
    Route::delete('stations/{id}', 'destroy');
    Route::get('stations/{id}/location', 'getLocation');
    Route::post('stations', 'search');
    Route::get('stations', 'getReviews');
});



Route::middleware('auth:api')->group(function () {
    // Chat API
    Route::post('/add-chat', [ChatController::class, 'addChat']);
    Route::get('/get-chats/{user_id}/{recipient_id}', [ChatController::class, 'getChats']);

    // Coin Request API
    Route::get('/get-all-coin-requests', [CoinRequestController::class, 'getAllRequest']);
    Route::post('/add-coin-request', [CoinRequestController::class, 'add']);
    Route::put('/update-coin-request/{id}', [CoinRequestController::class, 'update']);
    Route::delete('/delete-coin-request/{id}', [CoinRequestController::class, 'delete']);

    // Pass API
    Route::post('/add-pass', [PassController::class, 'addPass']);
    Route::get('/get-passes/{user_id}', [PassController::class, 'getPasses']);

    // Ride API
    Route::get('/rides-for-departure/{station_id}', [RideController::class, 'getRidesForDeparture']);
    Route::get('/rides-for-arrival/{station_id}', [RideController::class, 'getRidesForArrivalStation']);
    Route::put('/update-ride/{rideId}', [RideController::class, 'updateRide']);
    Route::delete('/delete-ride/{rideId}', [RideController::class, 'deleteRide']);
    Route::post('/add-ride', [RideController::class, 'addRide']);

    // Ticket API
    Route::post('/add-ticket', [TicketController::class, 'addTicket']);
    Route::get('/get-tickets/{user_id}', [TicketController::class, 'getTickets']);
});
