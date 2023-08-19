<?php

use App\Enums\Gender;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use BenSampo\Enum\Rules\EnumValue;
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

Route::middleware(['auth:sanctum', 'admin'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->get('/me', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->post('/me/update', function (Request $request) {
    $user = $request->user();

    $request->validate([
        'name' => 'string|max:255',
        'email' => 'string|email|max:255|unique:users',
        'gender' => ['string', new EnumValue(Gender::class)]
    ]);

    $user->update($request->except(['password']));

    $user->fresh();

    return response()->json(['user' => $user]);
});

Route::controller(CategoryController::class)->prefix('categories')->group(function () {
    Route::get('/', 'index');
    Route::get('/{category}', 'show');

    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::post('/', 'store');
        Route::post('/{category}', 'update');
        Route::delete('/{category}', 'destroy');
    });
});

Route::controller(DeliveryController::class)->prefix('deliveries')->group(function () {
    Route::get('/', 'index');
    Route::get('/{delivery}', 'show');

    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::post('/', 'store');
        Route::post('/{delivery}', 'update');
        Route::delete('/{delivery}', 'destroy');
    });
});

Route::controller(BoxController::class)->prefix('boxes')->group(function () {
    Route::get('/', 'index');
    Route::get('/{box}', 'show');

    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::post('/', 'store');
        Route::post('/{box}', 'update');
        Route::delete('/{box}', 'destroy');
    });
});

Route::controller(ProductController::class)->prefix('products')->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/favorites', 'usersFavorites');
        Route::post('/favorites', 'addFavorites');
        Route::post('/favorites/remove', 'removeFavorites');
    });

    Route::get('/', 'index');
    Route::get('/search', 'search');
    Route::get('/{product}', 'show');

    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::post('/', 'store');
        Route::post('/{product}', 'update');
        Route::delete('/{product}', 'destroy');
        Route::get('/admin/all', 'adminIndex');

    });
});

Route::controller(FeedbackController::class)->prefix('feedback')->group(function () {
    Route::get('/', 'index');
    Route::get('/{feedback}', 'show');

    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::post('/', 'store');
        Route::post('/{feedback}', 'update');
        Route::delete('/{feedback}', 'destroy');
    });
});

Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/registration', [AuthController::class, 'clientRegistration']);

Route::controller(OrderController::class)->prefix('orders')->group(function () {
    Route::get('/', 'index');

    Route::get('/last-delivery', 'lastDelivery')->middleware(['auth:sanctum']);

    Route::get('/{order}', 'show');

    Route::post('/', 'store');
//    Route::post('/{order}', 'update');
    Route::delete('/{order}', 'destroy');
});

Route::controller(FavoritesController::class)->prefix('favorites')->group(function () {
    Route::get('/', 'index');

    Route::get('/last-delivery', 'lastDelivery')->middleware(['auth:sanctum']);

    Route::get('/{order}', 'show');

    Route::post('/', 'store');
//    Route::post('/{order}', 'update');
    Route::delete('/{order}', 'destroy');
});
