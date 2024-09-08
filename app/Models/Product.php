<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory;
    use Searchable;
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
        'type'
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }
    #[SearchUsingFullText(['name', 'specifications','type'])]
    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'specifications' => $this->specifications,
            'type'=>$this->type
        ];
    }
}
