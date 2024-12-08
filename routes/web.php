<?php

use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subcategory;
use App\Services\BackBlazeService;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
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



Route::middleware('auth')->get('/orders', function () {
    $orders = Order::query()->where('user_id', '=', Auth::getUser()->id)->get()->toArray();
    $products = Order::getOrderProducts($orders);
    usort($orders, function ($a, $b) {
        // Place "pending" status first
        if ($a['status'] === 'pending' && $b['status'] !== 'pending') {
            return -1; // $a comes before $b
        }
        if ($a['status'] !== 'pending' && $b['status'] === 'pending') {
            return 1; // $b comes before $a
        }
        return 0; // Maintain the current order
    });
    error_log(json_encode($orders));
    
    return view('userOrderList', ['orders' => json_decode(json_encode($orders)), 'products' => $products]);
});

Route::get('/login', ['as' => 'login', 'uses' => function () {
    if (Auth::check()) {
       return redirect()->route('home');
    }
    return view('login');
}]);
Route::middleware('auth')->get('/verify', ['as' => 'verify', 'uses' => function () {
    error_log(json_encode(Auth::user()));
    return view('verifyNumber', ['number' => Auth::user()->phone_number]);
}]);
Route::middleware('auth')->get('/pending', ['as' => 'pendingTrader', 'uses' => function () {
     if (Auth::getUser()->type != 'pending') {
        return redirect()->route('home');
    } else {
        return view('pendingTrader');
    }
}]);
Route::get('/signup', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    } else {
        return view('signup');
    }
});
Route::get('/', ['as' => 'home', 'uses' => function (BackBlazeService $BackBlazeService) {
    error_log('home user is ' . json_encode(Auth::getUser()));

    $saleProducts = Product::query()->whereNotNull('discounted_price')->get();
    $products = Product::whereIn('category_id', [1, 2])->get();
    $categories = Category::query()->get();
    return view('home', ['categories' => $categories, 'saleProducts' => $saleProducts, 'products' => $products]);
}]);
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
        'subcategories' => $subcategories,
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
Route::prefix('admin')->group(function () {

    Route::get('/products', function () {
        $products = Product::all();
        return view('admin/adminProductList', ['items' => $products]);
    });
    Route::get('/categories', function () {
        $categories = Category::all();
        return view('admin/adminCategoryList', ['items' => $categories]);
    });
    Route::get('/subcategories', function () {
        $subcategories = Subcategory::with('category')->get();
        return view('admin/adminCategoryList', ['items' => $subcategories]);
    });
    Route::get('/traders', function () {
        $traders = User::whereIn('type', ['pending', 'trader'])->get();

        return view('admin/adminTradersList', ['items' => $traders]);
    });
    Route::get('/orders/completed', function () {
        $orders = Order::all();
        $products = Order::getOrderProducts($orders);
        return view('admin/adminOrderList', ['orders' => $orders, 'products' => $products, 'completed' => true]);
    });
    Route::get('/orders/pending', function () {
        $orders = Order::all();
        $products = Order::getOrderProducts($orders);
        error_log($products);
        return view('admin/adminOrderList', ['orders' => $orders, 'products' => $products, 'completed' => false]);
    });

    Route::get('/product/{id?}', function ($product_id = null) {
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
    Route::get('/new-category', function () {
        $categories = Category::all();
        return view('admin/adminNewCategory', ['isSubcategory' => false, 'categories' => $categories]);
    });

    Route::get('/new-subcategory', function () {
        $categories = Category::all();
        return view('admin/adminNewCategory', ['isSubcategory' => true, 'categories' => $categories]);
    });

    Route::get('/new-brand', function () {
        return view('admin/adminNewBrand');
    });

    Route::get('/category/{id}', function ($category_id) {
        $category = Category::query()->findOrFail($category_id);
        return view('admin/adminNewCategory', ['isSubcategory' => false, 'updatingItem' => $category]);
    });

    Route::get('/subcategory/{id}', function ($subcategory_id) {
        $subcategory = Subcategory::query()->findOrFail($subcategory_id);

        $categories = Category::all();
        return view('admin/adminNewCategory', ['isSubcategory' => true, 'updatingItem' => $subcategory,  'categories' => $categories]);
    });
});
