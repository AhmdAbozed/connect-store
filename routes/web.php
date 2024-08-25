<?php

use App\Http\Controllers\CategoryController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subcategory;
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
    return view('home', ['categories' => $categories, 'saleProducts' => $saleProducts, 'products' => $products, 'fileToken' => $downloadAuth->authorizationToken, 'fileUrl' => $downloadAuth->apiUrl]);
});

Route::get('/product/{id}', function ($product_id, BackBlazeService $BackBlazeService) {
    if (intval($product_id)) {
        $product = Product::query()->findOrFail($product_id);
        $relatedProducts = Product::query()->where('category_id', '=', $product->category_id)->whereNot('id', '=', $product->id)->get();
        $downloadAuth = $BackBlazeService->getAuthorizationToken();

        return view('product', ['product' => $product, 'relatedProducts' => $relatedProducts, 'fileToken' => $downloadAuth->authorizationToken, 'fileUrl' => $downloadAuth->apiUrl]);
    } else {
        abort(400, 'Invalid URL product id');
    }
});



Route::get('/categories/{id}', function ($category_id,  BackBlazeService $BackBlazeService) {
    $category = Category::query()->find($category_id);
    $subcategories = $category->subcategories()->get();
    $products = $category->products()->get();
    $downloadAuth = $BackBlazeService->getAuthorizationToken();
    return view('category', ['category' => $category, 'subcategories'=>$subcategories, 'products' => $products, 'fileToken' => $downloadAuth->authorizationToken, 'fileUrl' => $downloadAuth->apiUrl]);
});

Route::get('/categories/{id}/subcategories/{subcategory_id}', function ($category_id, $subcategory_id, BackBlazeService $BackBlazeService) {
    $category = Category::query()->find($category_id);
    $subcategory = Subcategory::query()->find($subcategory_id);
    $products = $subcategory->products()->get();
    $downloadAuth = $BackBlazeService->getAuthorizationToken();
    return view('category', ['category' => $category, 'subcategory'=>$subcategory, 'products' => $products, 'fileToken' => $downloadAuth->authorizationToken, 'fileUrl' => $downloadAuth->apiUrl]);
});

Route::get('/administrator/products', function () {
    $products = Product::all();
    return view('admin/adminProductList', ['items' => $products]);
});
Route::get('/administrator/categories', function () {
    $categories = Category::all();
    return view('admin/adminCategoryList', ['items' => $categories]);
});
Route::get('/administrator/subcategories', function () {
    $subcategories = Subcategory::with('category')->get();
    return view('admin/adminCategoryList', ['items' => $subcategories]);
});
Route::get('/administrator/orders/completed', function () {
    $orders = Order::all();
    $products = Order::getOrderProducts($orders);
    return view('admin/adminOrderList', ['items' => $orders, 'products'=>$products, 'completed'=>true]);
});
Route::get('/administrator/orders/pending', function () {
    $orders = Order::all();
    $products = Order::getOrderProducts($orders);
    return view('admin/adminOrderList', ['items' => $orders, 'products'=>$products, 'completed'=>false]);
});


Route::get('/administrator/new-product', function () {
    $categories = Category::all();
    $subcategories = Subcategory::all();
    return view('admin/adminNewProduct', ['categories' => $categories, 'subcategories'=>$subcategories, 'panel' => 1]);
});

Route::get('/administrator/new-category', function () {
    $categories = Category::all();
    return view('admin/adminNewCategory', ['isSubcategory'=>false, 'categories'=>$categories]);
});

Route::get('/administrator/new-subcategory', function () {
    $categories = Category::all();
    return view('admin/adminNewCategory', ['isSubcategory'=>true, 'categories' => $categories]);
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
    return view('admin/adminNewCategory', ['isSubcategory'=>false,'updatingItem' => $category]);
});

Route::get('/administrator/subcategory/{id}', function ($subcategory_id) {
    $subcategory = Subcategory::query()->findOrFail($subcategory_id);
    return view('admin/adminNewCategory', ['isSubcategory'=>true,'updatingItem' => $subcategory]);
});
