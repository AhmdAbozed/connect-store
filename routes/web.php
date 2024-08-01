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

Route::get('/', function (BackBlazeService $BackBlazeService) {
    
    $downloadAuth = $BackBlazeService->getAuthorizationToken();
    $saleProducts = Product::query()->whereNotNull('discounted_price')->get();
    error_log(json_encode($saleProducts));
    $products = Product::whereIn('category_id', [1, 2])->get();
    $categories = Category::query()->get();
    return view('home', ['categories'=>$categories, 'saleProducts'=>$saleProducts, 'products'=>$products, 'fileToken' => $downloadAuth->authorizationToken, 'fileUrl' => $downloadAuth->apiUrl]);
});

Route::get('/product/{id}', function ($product_id, BackBlazeService $BackBlazeService) {
    if (intval($product_id)) {
        $product = Product::query()->findOrFail($product_id); 
        $relatedProducts = Product::query()->where('category_id', '=',$product->category_id)->whereNot('id','=',$product->id)->get();
        $downloadAuth = $BackBlazeService->getAuthorizationToken();

        return view('product', ['product' => $product, 'relatedProducts'=> $relatedProducts, 'fileToken' => $downloadAuth->authorizationToken, 'fileUrl' => $downloadAuth->apiUrl]);
    } else {
        abort(400, 'Invalid URL product id');
    }
});



Route::get('/administrator/products', function () {
    $products = Product::all();
    return view('admin/adminProductList', ['items' => $products]);
});
Route::get('/administrator/categories', function () {
    $categories = Category::all();
    return view('admin/adminCategoryList', ['items' => $categories]);
});


Route::get('/administrator/new-product', function () {
    $categories = Category::all();
    $brands = Brand::all();
    return view('admin/adminNewProduct', ['categories' => $categories, 'brands' => $brands,'panel'=>1]);
});
Route::get('/administrator/new-category', function () {
    return view('admin/adminNewCategory');
});
Route::get('/administrator/new-brand', function () {
    return view('admin/adminNewBrand');
});



Route::get('/administrator/product/{id}', function ($product_id) {
    $product = Product::query()->findOrFail($product_id);
    $categories = Category::all();
    $brands = Brand::all();
    return view('admin/adminNewProduct', ['updatingItem' => $product, 'categories' => $categories, 'brands' => $brands]);
});
Route::get('/administrator/category/{id}', function ($category_id) {
    $category = Category::query()->findOrFail($category_id);
    return view('admin/adminNewCategory', ['updatingItem' => $category]);
});

