<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'user' => $this->whenLoaded('user'),
            'items' => ItemResource::collection($this->items),
            'user_information' => $this->user_information,
            'deliver_information' => $this->deliver_information,
            'alt_deliver_information' => $this->alt_deliver_information,
            'confirm_regulations_store' => $this->confirm_regulations_store,
            'confirm_privacy_policy' => $this->confirm_privacy_policy,
            'price' => $this->getPrice(),
            'deliver_price' => $this->getBoxPrice(),
            'created_at' => $this->created_at,
        ];
    }
}
