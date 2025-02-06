<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product_id' => $this->resource->product_id,
            'product_name' => $this->resource->product_name,
            'product_price' => $this->resource->product_price,
            'product_state' => $this->resource->product_state,
            'image_url' => $this->getFirstMediaUrl('image'),
        ];
    }
}
