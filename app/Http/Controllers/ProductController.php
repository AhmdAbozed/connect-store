<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\BackBlazeService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(BackBlazeService $BackBlazeService, Request $request)
    {
        error_log(json_encode($request->all()));
        error_log(json_encode(intval($request->input('Subcategory_id')) ?: null));
        $imgId = bin2hex(random_bytes(5));

        $itemData = [
            'name' => $request->input('Name'),
            'price' => $request->input('Price'),
            'discounted_price' => $request->input('Discounted_price'),
            'stock' => $request->input('Stock'),
            'specifications' => $request->input('Specifications'),
            'category_id' => intval($request->input('Category_id')),
            //?: returns the value if it exists, else returns null
            'subcategory_id' => intval($request->input('Subcategory_id')) ?: null,
            'img_id' => $imgId
        ];
        $product = '';
        if (intval($request->input('Updating_id'))) {
            error_log('updating product');
            $product = Product::query()->find($request->input('Updating_id'))->update($itemData);
        } else {
            $product = Product::query()->create($itemData);
        }
        $BackBlazeService->uploadFiles($request->file('Images'), $imgId);
        return response($product);
    }

    public function getProduct(Request $request, $product_id)
    {
        if (intval($product_id)) {
            $product = Product::query()->findOrFail($product_id);
            return response($product);
        } else {
            abort(400, 'Invalid URL product id');
        }
    }
    public function getProductsByCategory(Request $request, $category_id)
    {
        if (intval($category_id)) {
            $category = Category::query()->findOrFail($category_id);
            $products = $category->products()->get();
            return response($products);
        } else {
            abort(400, 'Invalid URL category id');
        }
    }
    public function deleteProduct(Request $request, BackBlazeService $BackBlazeService, int $product_id)
    {
        $imgId = Product::query()->find($product_id)->img_id;
        error_log($imgId);
        $BackBlazeService->deleteFiles('product/' . $imgId);
        $result = Product::destroy($product_id);
        return response($result);
    }
}
