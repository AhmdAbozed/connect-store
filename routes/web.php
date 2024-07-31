<?php

use App\Http\Controllers\CategoryController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\BackBlazeService;
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

Route::get('/well', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home');
});
Route::get('/product/{id}', function ($product_id, BackBlazeService $BackBlazeService) {
    if (intval($product_id)) {
        $product = Product::query()->findOrFail($product_id);
        $downloadAuth = $BackBlazeService->getAuthorizationToken();
        error_log(json_encode($downloadAuth));
        return view('product', ['product' => $product, 'fileToken' => $downloadAuth->authorizationToken, 'fileUrl' => $downloadAuth->apiUrl]);
    } else {
        abort(400, 'Invalid URL product id');
    }
});



Route::get('/administrator/products', function () {
    $products = Product::all();
    return view('adminList', ['products' => $products]);
});
Route::get('/administrator', function () {
    $categories = Category::all();
    $brands = Brand::all();
    return view('adminNew', ['categories' => $categories, 'brands' => $brands]);
});
Route::get('/administrator/product/{id}', function ($product_id) {
    $product = Product::query()->findOrFail($product_id);
    $categories = Category::all();
    $brands = Brand::all();
    return view('adminNew', ['updatingProduct' => $product, 'categories' => $categories, 'brands' => $brands]);
});

