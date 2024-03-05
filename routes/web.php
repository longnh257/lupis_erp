<?php

use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProductLogController;
use App\Http\Controllers\API\SalaryController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UserLogController;
use App\Http\Controllers\Pages\AuthController;
use App\Http\Controllers\Pages\EventPageController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\OrderPageController;
use App\Http\Controllers\Pages\ProductLogPageController;
use App\Http\Controllers\Pages\ProductPageController;
use App\Http\Controllers\Pages\SalaryPageController;
use App\Http\Controllers\Pages\UserLogPageController;
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
        Route::put('/{model}', [OrderPageController::class, 'update'])->name('view.order.update')->middleware('checkRole:superadmin,manager');
        Route::put('/staff-update/{model}', [OrderPageController::class, 'staff_update'])->name('view.order.staff-update');
        Route::delete('/{model}', [OrderPageController::class, 'destroy'])->name('view.order.destroy')->middleware('checkRole:superadmin,manager');
    });

    Route::group(['prefix' => 'event'], function () {
        Route::get('/', [EventPageController::class, 'index'])->name('view.event.index');
        Route::post('/', [EventPageController::class, 'store'])->name('view.event.store');
        Route::get('/edit/{model}', [EventPageController::class, 'edit'])->name('view.event.edit');
        Route::put('/{model}', [EventPageController::class, 'updateStatus'])->name('view.event.updateStatus');
        Route::delete('/{model}', [EventPageController::class, 'delete'])->name('view.event.delete');
        Route::get('/user-event', [EventPageController::class, 'user_event'])->name('view.user_event.index');
        Route::post('/user-event', [EventPageController::class, 'store_user_event'])->name('view.user_event.store');
    });
    //end user

    //User LOg
    Route::group(['prefix' => 'user-log'], function () {
        Route::get('/', [UserLogPageController::class, 'index'])->name('view.user-log.index');
    });
    //

    //salary
    Route::group(['prefix' => 'salary'], function () {
        Route::get('/', [SalaryPageController::class, 'index'])->name('view.salary.index');
        Route::get('/create', [SalaryPageController::class, 'create'])->name('view.salary.create');
        Route::post('/', [SalaryPageController::class, 'store'])->name('view.salary.store');
        Route::get('/edit/{model}', [SalaryPageController::class, 'edit'])->name('view.salary.edit');
        Route::put('/{model}', [SalaryPageController::class, 'update'])->name('view.salary.update');
        Route::put('/staff-update/{model}', [SalaryPageController::class, 'staff_update'])->name('view.salary.staff-update');
        Route::delete('/{model}', [SalaryPageController::class, 'destroy'])->name('view.salary.destroy')->middleware('checkRole:superadmin,manager');
    });
    //end salary

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

        Route::group(['prefix' => 'user-log'], function () {
            Route::get('/', [UserLogController::class, 'index'])->name('api.user-log.list');
        });

        Route::group(['prefix' => 'order'], function () {
            Route::get('/', [OrderController::class, 'index'])->name('api.order.list');
        });

        Route::group(['prefix' => 'salary'], function () {
            Route::get('/', [SalaryController::class, 'index'])->name('api.salary.list');
        });

        Route::group(['prefix' => 'event'], function () {
            Route::get('/user-event', [EventController::class, 'userEvent'])->name('api.event.user-event');
            Route::delete('/{model}', [EventController::class, 'delete'])->name('api.event.delete');
        });
    });
});
