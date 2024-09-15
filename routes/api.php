<?php

use App\Facades\DbConfig;
use Illuminate\Http\Request;
use App\Domain\Enums\PaymentMethods;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\OrdersController;
use App\Infra\Repositories\OrderRepository;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ToppingsController;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Infra\Repositories\DashboardRepository;

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/validate/token', [AuthController::class, 'validateToken'])->name('validate.token');

Route::prefix('user')->middleware('auth:sanctum', CheckAdminMiddleware::class)->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/address', [UserController::class, 'storeAddress'])->name('store.address');
    Route::delete('/address/{id}', [UserController::class, 'removeAddress'])->name('remove.address');
});

Route::prefix('admin')->middleware('auth:sanctum', CheckAdminMiddleware::class)->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/orders', [DashboardController::class, 'orders'])->name('dashboard.orders');
        Route::get('/orders/{id}', [DashboardController::class, 'show'])->name('dashboard.orders');
    });

    Route::prefix('users')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    Route::prefix('config')->group(function () {
        Route::get('/', [ConfigsController::class, 'index'])->name('config.index');
        Route::post('/deliveryfee', [ConfigsController::class, 'setDeliveryFee'])->name('config.deliveryfee');
        Route::post('/minimumorder', [ConfigsController::class, 'setMinimumOrder'])->name('config.minimumorder');
        Route::post('/maxdistance', [ConfigsController::class, 'setMaxDistanceForDelivery'])->name('config.maxdistance');
    });
});

Route::apiResource('products', ProductsController::class)->middleware('auth:sanctum');
Route::get('product/search', [ProductsController::class, 'search'])->middleware('auth:sanctum');

Route::apiResource('groups', GroupsController::class)->middleware('auth:sanctum');

Route::apiResource('toppings', ToppingsController::class)->middleware('auth:sanctum');

Route::get('/teste', function (DashboardRepository $repo) {
    return response()->json($repo->getSales('2024-08-10', '2024-10-15'));
});

Route::post('/order', [OrdersController::class, 'store'])->middleware('auth:sanctum');
Route::get('/order/{id}', [OrdersController::class, 'getProductByUserId'])->middleware('auth:sanctum');
