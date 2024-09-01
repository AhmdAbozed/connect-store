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
        ];
        $categoryResult = $category::addCategory($itemData, $request->file('Image'), intval($request->input('Updating_id')), $backBlazeService, $imgId);
        return response($categoryResult);
    }
    
    public function getCategories(Request $request)
    {
        $categories = Category::all();
        return response($categories);
    }

    public function deleteCategory(Request $request, Category $category, BackBlazeService $backBlazeService, int $category_id)
    {
        $result = $category::deleteCategory($backBlazeService, $category_id);
        return response($result);
      
    }
}
