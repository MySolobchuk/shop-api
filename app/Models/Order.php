<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property  array<Item> $items
 */
class Order extends Model
{
    protected $table = 'orders';

    protected $guarded = ['status'];

    protected $fillable = [
        'user_id',
        'user_information',
        'deliver_information',
        'alt_deliver_information',
        'confirm_regulations_store',
        'confirm_privacy_policy',
    ];

    protected $casts = [
        'user_information' => 'array',
        'deliver_information' => 'array',
        'alt_deliver_information' => 'array',
        'confirm_regulations_store' => 'boolean',
        'confirm_privacy_policy' => 'boolean',
    ];
    /**
     * @var int
     */

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getPrice(): float
    {
        $price = null;

        foreach ($this->items as $item) {
            $price+= $item->getPrice();
        }

        return round($price, 2);
    }

    public function getBoxPrice(): float
    {
        $price = null;

        foreach ($this->items as $item) {
            $price+= $item->boxPrice();
        }

        return round($price, 2);
    }

    public function startCheckout()
    {
        $this->status = 1;
    }

    public function verify(int $pid)
    {
        $this->pid = $pid;
        $this->status = 2;
    }
}
