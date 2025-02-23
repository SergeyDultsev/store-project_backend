<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_id' => $this->resource->order_id,
            'product_id' => $this->resource->product->product_id,
            'product_name' => $this->resource->product->product_name,
            'quantity' => $this->resource->quantity,
        ];
    }
}
