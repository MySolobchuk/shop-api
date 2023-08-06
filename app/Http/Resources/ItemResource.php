<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'product' => ProductInOrderResource::make($this->whenLoaded('product')),
            'product_id' => $this->product_id,
            'count' => $this->count,
            'box_count' => $this->boxCount(),
            'box_price' => round($this->product->box->price, 2),
            'box_total_price' => $this->boxPrice(),
            'price' => $this->getPrice(),
        ];
    }
}
