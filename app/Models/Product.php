<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'discounted_price',
        'specifications',
        'stock',
        'img_id',
        'category_id',
        'subcategory_id',
        'brand_id'
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);

    }
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);

    }
    
}
