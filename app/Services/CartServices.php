<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Ramsey\Uuid\Uuid;

class CartServices{
    public function indexCart(): LengthAwarePaginator
    {
        return Cart::with('product')->paginate(100);
    }

    public function addCart($productId): void
    {
        $cart = new Cart();
        $cart->cart_id = Uuid::uuid4()->toString();
        $cart->product_id = $productId;
        $cart->user_id = auth()->id();
        $cart->quantity = 1;
        $cart->save();

        $product = Product::where("product_id", $productId)->first();
        $product->product_state = "in_cart";
        $product->save();
    }

    public function updateCart($cartId, int $quantity): ?Cart
    {
        $cart = Cart::where("cart_id", $cartId)->first();
        if (!$cart) return null;

        if ($cart->quantity + $quantity <= 0) return null;
        $cart->quantity += $quantity;
        $cart->save();

        return $cart;
    }

    public function deleteCart($cartId): ?Cart
    {
        $cart = Cart::where("cart_id", $cartId)->first();
        if (!$cart) return null;

        $productId = $cart->product_id;
        $product = Product::where("product_id", $productId)->first();
        $product->product_state = "available";
        $product->save();

        $cart->delete();
        return $cart;
    }
}
