<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

/**
 * @property integer $discount
 * @property float $price
 * @property Category $category
 */
class Product extends Model
{
    use Searchable;
    protected $fillable = [
        'name',
        'labelMark',
        'description',
        'discount',
        'discount_label',
        'price',
        'code',
        'preview',
        'category_id',
        'promoCod',
        'status',
        'quantity',
        'delivery_id',
        'size',
        'unit_of_measure',
        'images',
        'weight',
        'type',
        'box_id'
    ];

    protected $casts = [
        'status' => 'boolean',
        'quantity' => 'integer',
        'discount' => 'integer',
        'images' => 'array'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'code' => $this->code
        ];
    }
}
