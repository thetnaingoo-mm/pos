<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BrandController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\LocationController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\SupplierController;
use App\Http\Controllers\Api\V1\UnitController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.v1.')->group(function (): void {
    Route::prefix('auth')->name('auth.')->group(function (): void {
        Route::post('/login', [AuthController::class, 'login'])
            ->name('login');

        Route::middleware('auth:sanctum')->group(function (): void {
            Route::post('/logout', [AuthController::class, 'logout'])
                ->name('logout');

            Route::get('/me', [AuthController::class, 'me'])
                ->name('me');
        });
    });

    Route::middleware('auth:sanctum')->group(function (): void {
        Route::apiResources([
            'categories' => CategoryController::class,
            'brands' => BrandController::class,
            'units' => UnitController::class,
            'products' => ProductController::class,
            'customers' => CustomerController::class,
            'suppliers' => SupplierController::class,
            'locations' => LocationController::class,
        ]);
    });
});