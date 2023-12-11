<?php

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

Route::apiResource('category_product', App\Http\Controllers\CategoryProductController::class);
// Route::apiResource('product', App\Http\Controllers\ProductController::class);
Route::prefix('product')->group(function () {

    Route::get('/', [App\Http\Controllers\ProductController::class, 'index']);
    Route::get('/get-product/{id}', [App\Http\Controllers\ProductController::class, 'get_product']);
    Route::post('/', [App\Http\Controllers\ProductController::class, 'store']);
    Route::get('/{id}', [App\Http\Controllers\ProductController::class, 'show']);
    Route::put('/{product}', [App\Http\Controllers\ProductController::class, 'update']);
    Route::delete('/{product}', [App\Http\Controllers\ProductController::class, 'destroy']);
});

Route::post('/add-cart', [App\Http\Controllers\CartController::class, 'add_cart']);
Route::post('/update-cart', [App\Http\Controllers\CartController::class, 'update_cart']);
Route::post('/cart', [App\Http\Controllers\CartController::class, 'cart']);
