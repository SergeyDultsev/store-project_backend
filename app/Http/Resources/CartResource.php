<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cart_id' => $this->resource->cart_id,
            'product_id' => $this->resource->product->product_id,
            'product_name' => $this->resource->product->product_name,
            'product_price' => $this->resource->product->product_price,
            'product_state' => $this->resource->state,
            'quantity' => $this->resource->quantity,
        ];
    }
}
