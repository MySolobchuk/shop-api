<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Product $product
 * @property float $count
 */
class Box extends Model
{
    protected $fillable = [
        'title',
        'size',
        'price',
        'delivery_id',
        'methodPayment',
    ];

    protected $casts = [
        'title' => 'string',
        'size' => 'integer',
        'price' => 'float',
    ];

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }
}
