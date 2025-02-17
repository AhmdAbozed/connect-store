<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;


Route::post('/user/signup', [UserController::class, 'signup']);
Route::post('/user/signout', [UserController::class, 'signout']);
Route::post('/user/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user/order/{id}/delete', [OrderController::class, 'deleteOrder']);

Route::post('/user/verify', [UserController::class, 'verifyNumber']);
Route::post('/user/verify/resend', [UserController::class, 'sendOtp']);

Route::get('/product', [ProductController::class, 'getProducts']);
Route::get('/product/{id}', [ProductController::class, 'getProducts']);
Route::get('/categories', [CategoryController::class, 'getCategories']);

Route::get('/brand', [BrandController::class, 'getBrands']);
Route::get('/product', [ProductController::class, 'getProducts']);

//used by cart
Route::post('/products', [ProductController::class, 'getProductsByIds']);

Route::post('/product/search', [ProductController::class, 'searchProducts']);

Route::post('/order', [OrderController::class, 'addOrder']);

Route::get('/order', [OrderController::class, 'getOrders']);

if(!config('app.demo_mode')){
    Route::post('/product', [ProductController::class, 'addProduct']);
    Route::post('/category', [CategoryController::class, 'addCategory']);
    Route::post('/subcategory', [SubcategoryController::class, 'addSubcategory']);
    
    Route::post('/administrator/product/delete/{id}', [ProductController::class, 'deleteProduct']);
    Route::post('/administrator/category/delete/{id}', [CategoryController::class, 'deleteCategory']);
    Route::post('/administrator/subcategory/delete/{id}', [SubcategoryController::class, 'deleteSubcategory']);
    
    Route::post('/administrator/order/{id}', [OrderController::class, 'updateOrder']);
    
}
Route::post('/administrator/user/{id}', [UserController::class, 'approveTrader']);
