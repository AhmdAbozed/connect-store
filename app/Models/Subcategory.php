<?php

namespace App\Models;

use App\Services\BackBlazeService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'img_id',
        'category_id'
    ];
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    static public function addSubcategory(array $subcategory, UploadedFile $image, int $updatingId, BackBlazeService $BackBlazeService, string $imgId)
    {
        error_log('adding category');
        //Need clarification on code behaviour here
        $result = '';
        if (intval($updatingId)) {
            error_log('updating product');
            $result = Subcategory::query()->find($updatingId)->update($subcategory);
        } else {
            $result = Subcategory::query()->create($subcategory);
        }
        error_log('uploading category file');
        $BackBlazeService->uploadFiles([$image], $imgId);
        return response($result);
    }

    static public function deleteSubcategory(BackBlazeService $BackBlazeService, int $subcategory_id)
    {

        $subcategory = Subcategory::query()->find($subcategory_id);
        if ($subcategory) {
            if ($subcategory->products()->first()) {
                abort(400, 'Category not empty');
            } else {
                $BackBlazeService->deleteFiles('product/' . $subcategory->img_id);
                $result = Subcategory::destroy($subcategory_id);
                return response($result);
            }
        }
    }
}
