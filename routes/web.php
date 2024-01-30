<?php

use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProductLogController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Pages\AuthController;
use App\Http\Controllers\Pages\EventPageController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\OrderPageController;
use App\Http\Controllers\Pages\ProductLogPageController;
use App\Http\Controllers\Pages\ProductPageController;
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

    //Product
    Route::group(['prefix' => 'product', 'middleware' => 'checkRole:superadmin,manager'], function () {
        Route::get('/', [ProductPageController::class, 'index'])->name('view.product.index');
        Route::get('/create', [ProductPageController::class, 'create'])->name('view.product.create');
        Route::post('/', [ProductPageController::class, 'store'])->name('view.product.store');
        Route::get('/edit/{model}', [ProductPageController::class, 'edit'])->name('view.product.edit');
        Route::put('/{model}', [ProductPageController::class, 'update'])->name('view.product.update');
        Route::delete('/{model}', [ProductPageController::class, 'destroy'])->name('view.product.destroy');
    });

    //Product Log
    Route::group(['prefix' => 'product-log'], function () {
        Route::get('/', [ProductLogPageController::class, 'index'])->name('view.product-log.index');
    });

    //Order
    Route::group(['prefix' => 'order'], function () {
        Route::get('/', [OrderPageController::class, 'index'])->name('view.order.index');
        Route::get('/create', [OrderPageController::class, 'create'])->name('view.order.create')->middleware('checkRole:superadmin,manager');
        Route::post('/', [OrderPageController::class, 'store'])->name('view.order.store');
        Route::get('/edit/{model}', [OrderPageController::class, 'edit'])->name('view.order.edit');
        Route::put('/{model}', [OrderPageController::class, 'update'])->name('view.order.update');
        Route::put('/staff-update/{model}', [OrderPageController::class, 'staff_update'])->name('view.order.staff-update');
        Route::delete('/{model}', [OrderPageController::class, 'destroy'])->name('view.order.destroy')->middleware('checkRole:superadmin,manager');
    });

    Route::group(['prefix' => 'event'], function () {
        Route::get('/', [EventPageController::class, 'index'])->name('view.event.index');
    });

    //end user

});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'api'], function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index'])->name('api.user.list');
        });

        Route::group(['prefix' => 'product'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('api.product.list');
        });

        Route::group(['prefix' => 'product-log'], function () {
            Route::get('/', [ProductLogController::class, 'index'])->name('api.product-log.list');
        });

        Route::group(['prefix' => 'order'], function () {
            Route::get('/', [OrderController::class, 'index'])->name('api.order.list');
        });
    });
});
