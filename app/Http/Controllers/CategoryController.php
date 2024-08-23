<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\BackBlazeService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory(Request $request, Category $category, BackBlazeService $backBlazeService)
    {

        $imgId = bin2hex(random_bytes(5));
        $itemData = [
            'name' => $request->input('Name'),
            'img_id' => $imgId,
            'specifications' => $request->input('Specifications'),
        ];
        $category = $category::addCategory($itemData, $request->file('Image'), intval($request->input('Updating_id')), $backBlazeService, $imgId);
        return response($category);
    }
    public function getCategories(Request $request)
    {
        $categories = Category::all();
        return response($categories);
    }

    public function deleteCategory(Request $request, BackBlazeService $BackBlazeService, int $category_id)
    {
        $category = Category::query()->find($category_id);
        error_log(json_encode($category->products()->first()));
        if ($category) {
            if ($category->products()->first()) {
                return response('Category not empty', 400);
            } else {
                $BackBlazeService->deleteFiles('product/' . $category->img_id);
                $result = Category::destroy($category_id);
                return response($result);
            }
        }
    }
}
