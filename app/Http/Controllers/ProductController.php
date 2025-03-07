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
            'wholesale' => $request->input('Wholesale'),
            'stock' => $request->input('Stock'),
            'specifications' => $request->input('Specifications'),
            'category_id' => intval($request->input('Category_id')),
            'subcategory_id' => intval($request->input('Subcategory_id')) ?: null,
            'type' => Category::query()->find($request->input('Category_id'))->name
        ];
        $product = '';
        if (intval($request->input('Updating_id'))) {
            error_log('updating product');
            error_log(json_encode($itemData));

            if ($request->file('Images')) $itemData['img_id'] = $imgId;
            error_log(json_encode($itemData));

            $product = Product::query()->find($request->input('Updating_id'));
            $product->update($itemData);
        } else {
            $itemData['img_id'] = $imgId;
            $product = Product::query()->create($itemData);
        }
        if ($request->file('Images')) $BackBlazeService->uploadFiles($request->file('Images'), $imgId);
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

    public function getProductsByIds(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer'
        ]);

        $products = Product::whereIn('id', $validated['ids'])->get();

        return response()->json($products);
    }

    public function searchProducts(Request $request)
    {
        $query = $request->input('query');
        return response(Product::search($query)->get());
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
