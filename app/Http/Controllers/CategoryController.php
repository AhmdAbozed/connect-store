<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\BackBlazeService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory(Request $request, BackBlazeService $BackBlazeService)
    {
        error_log($request->hasFile('Image'));
        error_log($request->file('Image'));
        $imgId = bin2hex(random_bytes(5));
        $itemData = [
            'name' => $request->input('Name'),
            'img_id' => $imgId,
            'specifications'=> $request->input('Specifications')
        ];
        //Need clarification on code behaviour here
        $category = '';
        if (intval($request->input('Updating_id'))) {
            error_log('updating product');
            $category = Category::query()->find($request->input('Updating_id'))->update($itemData);
        } else {
            $category = Category::query()->create($itemData);
        }
        $BackBlazeService->uploadFiles([$request->file('Image')], $imgId);
        return response($category);
    }
    public function getCategories(Request $request)
    {
        $categories = Category::all();
        return response($categories);
    }
}
