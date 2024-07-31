<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
        $category = Category::query()->create([
            'name' => $request->input('Name'),

        ]);
        return response($category);
    }
    public function getCategories(Request $request)
    {
        $categories = Category::all();
        return response($categories);
    }
}
