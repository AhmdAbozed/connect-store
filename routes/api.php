<?php

use App\Http\Controllers\BrandController;
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
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/product', [ProductController::class, 'getProducts']);
Route::get('/product/{id}', [ProductController::class, 'getProducts']);
Route::get('/categories', [CategoryController::class, 'getCategories']);
Route::get('/brand', [BrandController::class, 'getBrands']);
Route::get('/product', [ProductController::class, 'getProducts']);

Route::post('/product', [ProductController::class, 'addProduct']);
Route::post('/category', [CategoryController::class, 'addCategory']);
Route::post('/brand', [BrandController::class, 'addBrand']);


Route::post('/administrator/product/delete/{id}', [ProductController::class, 'deleteProduct']);