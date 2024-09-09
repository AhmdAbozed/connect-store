<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Services\BackBlazeService;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function addSubcategory(Request $request, Subcategory $subcategory, BackBlazeService $backBlazeService)
    {
       
        $itemData = [
            'name' => $request->input('Name'),
            'specifications' => $request->input('Specifications'),
            'category_id' => intval($request->input('Category_id')),
        ];
        $imgId = bin2hex(random_bytes(5));
        //not updating OR is updating but no new image, so don't update old imgId 
        if (!intval($request->input('Updating_id')) || (intval($request->input('Updating_id')) && $request->file('Image'))) {
            $itemData['img_id'] = $imgId;
        }
        error_log('er'.json_encode((!intval($request->input('Updating_id')) )));
        error_log('er1'.json_encode((intval($request->input('Updating_id')) && !$request->file('Image'))));
        $categoryResult = $subcategory::addSubcategory($itemData,  intval($request->input('Updating_id')), $backBlazeService, $imgId, $request->file('Image') ?: null);
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
