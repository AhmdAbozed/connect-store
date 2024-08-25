<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Services\BackBlazeService;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function addSubcategory(Request $request, Subcategory $subcategory, BackBlazeService $backBlazeService)
    {

        $imgId = bin2hex(random_bytes(5));

        $itemData = [
            'name' => $request->input('Name'),
            'img_id' => $imgId,
            'category_id' => intval($request->input('Category_id')),
        ];
        $categoryResult = $subcategory::addSubcategory($itemData, $request->file('Image'), intval($request->input('Updating_id')), $backBlazeService, $imgId);
        return response($categoryResult);
    }

    public function getSubcategories(Request $request)
    {
        $subcategories = Subcategory::all();
        return response($subcategories);
    }

    public function deleteSubcategory(Request $request, Subcategory $subcategory, BackBlazeService $backBlazeService, int $category_id)
    {
        $result = $subcategory::deleteSubcategory($backBlazeService, $category_id);
        return response($result);
    }
}
