<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'labelMark',
        'description',
        'first_price',
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
