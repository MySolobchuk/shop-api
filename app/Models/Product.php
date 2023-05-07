<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $discount
 * @property float $price
 * @property Category $category
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'labelMark',
        'description',
        'discount',
        'price',
        'code',
        'preview',
        'category_id',
        'promoCod',
        'status',
        'quantity',
        'unit_of_measure',
        'images'
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

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }
}
