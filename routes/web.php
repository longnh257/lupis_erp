<?php

use App\Http\Controllers\Pages\AuthController;
use App\Http\Controllers\Pages\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Router Không cần check login 
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home_page');
});

Route::middleware(['checkRole:admin'])->group(function () {
    Route::get('/admin-only', function () {
        return 'Chào mừng bạn, admin!';
    });
});

