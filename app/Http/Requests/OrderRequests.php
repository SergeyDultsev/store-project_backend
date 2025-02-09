<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'order' => ["required", "array", "min:1"],
            'order.*cart_id' => ["required", "string", 'uuid', 'exists:carts,cart_id'],
            'order.*product_id' => ["required", "string", 'uuid', 'exists:products,product_id'],
            'order.*quantity' => ["required", "integer", "min:1"],
            'order.*price' => ["required", "numeric", "min:0.01"],
        ];
    }
}
