<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Pages\AuthController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\UserPageController;
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

    //Webpage
    Route::get('/', [HomeController::class, 'index'])->name('home_page');

    //User
    Route::group(['prefix' => 'user', 'middleware' => 'checkRole:superadmin'], function () {
        Route::get('/', [UserPageController::class, 'index'])->name('view.user.index');
        Route::get('/create', [UserPageController::class, 'create'])->name('view.user.create');
        Route::post('/', [UserPageController::class, 'store'])->name('view.user.store');
        Route::get('/edit/{model}', [UserPageController::class, 'edit'])->name('view.user.edit');
        Route::put('/{model}', [UserPageController::class, 'update'])->name('view.user.update');
        Route::delete('/{model}', [UserPageController::class, 'destroy'])->name('view.user.destroy');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/profile', [UserPageController::class, 'profile'])->name('view.user.profile');
        Route::put('/update-profile', [UserPageController::class, 'update_profile'])->name('view.user.update-profile');
    });

    //end user

});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'api'], function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index'])->name('api.user.list');
        });
    });
});
