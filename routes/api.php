<?php

use App\Http\Controllers\API\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'event'], function () {
        Route::get('/', [EventController::class, 'index'])->name('api.event.list');
        Route::post('/', [EventController::class, 'store'])->name('api.event.store');
        Route::get('/user-event', [EventController::class, 'userEvent'])->name('api.event.user-event');
        Route::put('/approve-event', [EventController::class, 'approveEvent'])->name('api.event.approve-event');
        Route::put('/pending-event', [EventController::class, 'pendingEvent'])->name('api.event.pending-event');
    });
});
