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
            'price' => $this->getPrice(),
        ];
    }
}
