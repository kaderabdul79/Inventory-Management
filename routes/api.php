<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
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

// Categories
Route::resource('categories', CategoryController::class);
Route::get('/active-categories', [CategoryController::class,'getActiveCategories']);
// Sizes
Route::resource('sizes', SizeController::class);
Route::get('/active-sizes', [SizeController::class,'getActiveSizes']);

// Brands
Route::resource('brands', BrandController::class);
Route::get('/active-brands', [BrandController::class,'getActiveBrands']);
// Products
Route::resource('products', ProductController::class);
Route::get('products/search', [ProductController::class,'search']);