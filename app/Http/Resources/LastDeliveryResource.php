<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LastDeliveryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'deliver_information' => $this->deliver_information ?? null,
            'alt_deliver_information' => $this->alt_deliver_information ?? null,
        ];
    }
}
