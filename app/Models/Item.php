<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Product $product
 * @property float $count
 */
class Item extends Model
{
    protected $fillable = [
        'count',
        'product_id',
        'order_id'
    ];

    protected $casts = [
        'count' => 'integer',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getPrice(): float
    {
        $price = ($this->product->price * $this->count) + $this->boxPrice();

        return round($this->product->discount ? $price - ($price * $this->product->discount / 100) : $price, 2);
    }

    public function boxCount(): int
    {
        $box = $this->product->box;

        $totalSize = $this->product->size * $this->count;

        return ceil($totalSize / $box->size);
    }

    public function boxPrice(): float
    {
        return round($this->boxCount() * $this->product->box->price, 2);
    }
}
