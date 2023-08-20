<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property Product $product
 * @property float $count
 */
class Delivery extends Model
{
    protected $fillable = [
        'title',
        'time',
        'payment',
        'protected',
        'methodPayment',
    ];

    protected $casts = [
        'title' => 'string',
    ];


    public function boxes(): HasMany
    {
        return $this->hasMany(Box::class);
    }
}
