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
        error_log($request->hasFile('Images'));
        $imgId = bin2hex(random_bytes(5));
        $itemData = [
            'name' => $request->input('Name'),
            'price' => $request->input('Price'),
            'discounted_price' => $request->input('Discounted_price'),
            'stock' => $request->input('Stock'),
            'specifications' => $request->input('Specifications'),
            'category_id' => intval($request->input('Category_id')),
            'brand_id' => intval($request->input('Brand_id')),
            'img_id' => $imgId
        ];
        error_log('update id: '.$request->input('Updating_id'));
        if (intval($request->input('Updating_id'))) {
            
        error_log('updating product');
            $product = Product::query()->find($request->input('Updating_id'))->update($itemData);
            $BackBlazeService->uploadFiles($request->file('Images'), $imgId);
            return response(['id'=>$request->input('Updating_id')]);
        } else {
            $product = Product::query()->create($itemData);
            $BackBlazeService->uploadFiles($request->file('Images'), $imgId);
            return response($product);
        }
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
    public function deleteProduct(Request $request, int $product_id){
        $result = Product::destroy($product_id);
        return response($result);
    }
}
