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
        'img_id',
        'specifications'
    ];
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    static public function addCategory(array $category, UploadedFile $image, int $updatingId, BackBlazeService $BackBlazeService, string $imgId)
    {
        error_log('testing3');
        //Need clarification on code behaviour here
        $result = '';
        if (intval($updatingId)) {
            error_log('updating product');
            $result = Category::query()->find($updatingId)->update($category);
        } else {
            $result = Category::query()->create($category);
        }
        $BackBlazeService->uploadFiles([$image], $imgId);
        return response($result);
    }
}
