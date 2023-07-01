<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function paginationInformation($request, $paginated, $default)
    {
        $default['meta']['max_price'] = 'https://example.com';
        $default['meta']['min_price'] = 'https://example.com';

        return $default;
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request)
    {

        return [
            'meta' => [
                'key' => 'value',
            ],
        ];
    }
}
