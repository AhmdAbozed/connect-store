<?php

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subcategory;
use App\Services\BackBlazeService;
use Illuminate\Http\Client\Request;
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

    $saleProducts = Product::query()->whereNotNull('discounted_price')->get();
    error_log(json_encode($saleProducts));
    $products = Product::whereIn('category_id', [1, 2])->get();
    $categories = Category::query()->get();
    return view('home', ['categories' => $categories, 'saleProducts' => $saleProducts, 'products' => $products]);
});
Route::get('/builder', function (BackBlazeService $BackBlazeService) {

    $recorderName = 'Video Recorders';
    $cameraName = 'Security Cameras';
    $PDUName = 'Power Supplies';
    $cableName = 'Camera Cables';
    $accName = 'Surveillance Equipment';
    $monitorName = 'Monitors';
    $hddName = 'Hard Drives';
    $switchesName = 'Network Switches';
    $subcategoryNames = [$recorderName, $PDUName, $cameraName, $cableName, $accName, $hddName, $switchesName, $monitorName];

    $productsBySubcategory = Product::with('subcategory')->whereHas('subcategory', function ($query) use ($subcategoryNames) {
        $query->whereIn('name', $subcategoryNames);
    })->get();
    $subcategories = Subcategory::whereIn('name', $subcategoryNames)->get()->keyBy('name');
    $recorders = $productsBySubcategory->get($recorderName) ?? collect();
    $cameras = $productsBySubcategory->get($cameraName) ?? collect();
    $PDUs = $productsBySubcategory->get($PDUName) ?? collect();
    $cables = $productsBySubcategory->get($cableName) ?? collect();
    $accessories = $productsBySubcategory->get($accName) ?? collect();
    $hardDrives = $productsBySubcategory->get($hddName) ?? collect();
    $switches = $productsBySubcategory->get($switchesName) ?? collect();
    $monitors = $productsBySubcategory->get($monitorName) ?? collect();

    return view('securityBuilder', [
        'recorders' => $recorders,
        'PDUs' => $PDUs,
        'cameras' => $cameras,
        'cables' => $cables,
        'accessories' => $accessories,
        'hardDrives' => $hardDrives,
        'switches' => $switches,
        'monitors' => $monitors,
        'subcategories'=>$subcategories,
    ]);
});

Route::get('/product/{id}', function ($product_id, BackBlazeService $BackBlazeService) {
    if (intval($product_id)) {
        $product = Product::query()->findOrFail($product_id);
        $relatedProducts = Product::query()->where('category_id', '=', $product->category_id)->whereNot('id', '=', $product->id)->get();

        return view('product', ['product' => $product, 'relatedProducts' => $relatedProducts]);
    } else {
        abort(400, 'Invalid URL product id');
    }
});

Route::get('/categories/{id}', function ($category_id,  BackBlazeService $BackBlazeService) {
    $category = Category::query()->find($category_id);
    $subcategories = $category->subcategories()->get();
    $products = $category->products()->get();
    return view('category', ['category' => $category, 'subcategories' => $subcategories, 'products' => $products]);
});

Route::get('/categories/{category_id}/subcategories/{subcategory_id}/{builder?}', function ($category_id, $subcategory_id, $builder = '') {

    $subcategory = Subcategory::query()->find($subcategory_id);
    $category = Category::query()->find($category_id);
    $products = $subcategory->products()->with('subcategory')->get();
    if ($builder == 'builder') {
        return view('category', ['building' => true, 'category' => $category, 'subcategory' => $subcategory, 'products' => $products]);
    } else return view('category', ['category' => $category, 'subcategory' => $subcategory, 'products' => $products]);
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
    return view('admin/adminOrderList', ['orders' => $orders, 'products' => $products, 'completed' => true]);
});
Route::get('/administrator/orders/pending', function () {
    $orders = Order::all();
    $products = Order::getOrderProducts($orders);
    error_log($products);
    return view('admin/adminOrderList', ['orders' => $orders, 'products' => $products, 'completed' => false]);
});

Route::get('/administrator/product/{id?}', function ($product_id = null) {
    $categories = Category::all();
    $subcategories = Subcategory::all();
    $products = Product::all(['id', 'category_id', 'specifications', 'name', 'subcategory_id']);
    if ($product_id) {
        return view('admin/adminNewProduct', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'products' => $products,
            'updatingItem' => $products->find($product_id)
        ]);
    } else {
        return view('admin/adminNewProduct', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'products' => $products
        ]);
    }
});
Route::get('/administrator/new-category', function () {
    $categories = Category::all();
    return view('admin/adminNewCategory', ['isSubcategory' => false, 'categories' => $categories]);
});

Route::get('/administrator/new-subcategory', function () {
    $categories = Category::all();
    return view('admin/adminNewCategory', ['isSubcategory' => true, 'categories' => $categories]);
});

Route::get('/administrator/new-brand', function () {
    return view('admin/adminNewBrand');
});

Route::get('/administrator/category/{id}', function ($category_id) {
    $category = Category::query()->findOrFail($category_id);
    return view('admin/adminNewCategory', ['isSubcategory' => false, 'updatingItem' => $category]);
});

Route::get('/administrator/subcategory/{id}', function ($subcategory_id) {
    $subcategory = Subcategory::query()->findOrFail($subcategory_id);

    $categories = Category::all();
    return view('admin/adminNewCategory', ['isSubcategory' => true, 'updatingItem' => $subcategory,  'categories' => $categories]);
});
