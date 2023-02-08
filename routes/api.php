<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});

Route::controller(CategoryController::class)->prefix('categories')->group(function () {
    Route::get('/', 'index');
    Route::get('/{category}', 'show');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', 'store');
        Route::post('/{category}', 'update');
        Route::delete('/{category}', 'destroy');
    });
});

Route::controller(ProductController::class)->prefix('products')->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', 'store');
        Route::post('/{product}', 'update');
        Route::delete('/{product}', 'destroy');
    });
});

Route::post('/admin/login', [AuthController::class, 'login']);
