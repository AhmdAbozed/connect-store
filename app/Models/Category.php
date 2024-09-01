<?php

namespace App\Models;

use App\Services\BackBlazeService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'img_id'
    ];
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }
    static public function addCategory(array $category, UploadedFile $image, int $updatingId, BackBlazeService $BackBlazeService, string $imgId)
    {
        error_log('adding category');
        //Need clarification on code behaviour here
        $result = '';
        if (intval($updatingId)) {
            error_log('updating product');
            $result = Category::query()->find($updatingId)->update($category);
        } else {
            $result = Category::query()->create($category);
        }
        error_log('uploading category file');
        $BackBlazeService->uploadFiles([$image], $imgId);
        return response($result);
    }

    static public function deleteCategory(BackBlazeService $BackBlazeService, int $category_id)
    {

        $category = Category::query()->find($category_id);
        if ($category) {
            if ($category->products()->first()) {
                abort(400, 'Category not empty');
            } else {
                $BackBlazeService->deleteFiles('product/' . $category->img_id);
                $result = Category::destroy($category_id);
                return response($result);
            }
        }
    }
}
