<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $fillable = [
        'name',
        'product_id',
        'message',
        'avatar'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
