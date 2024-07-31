<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function addBrand(Request $request)
    {
        $brand = Brand::query()->create([
            'name' => $request->input('Name')
            
        ]);
       return response($brand);
    }
    public function getBrands(Request $request)
    {
        $brands = Brand::all();
        return response($brands);
    }
}
