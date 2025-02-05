<?php

namespace App\Services;

use App\Models\Cart;
use Ramsey\Uuid\Uuid;

class CartServices{
    public function indexCart(): object
    {
        return Cart::with('product')->get();
    }

    public function addCart($productId): void
    {
        $cart = new Cart();
        $cart->cart_id = Uuid::uuid4()->toString();
        $cart->product_id = $productId;
        $cart->user_id = auth()->id();
        $cart->quantity = 1;
        $cart->save();
    }

    public function updateCart(int $cartId, int $quantity): ?Cart
    {
        $cart = Cart::find($cartId);
        if (!$cart) return null;

        if ($cart->quantity + $quantity <= 0) return null;
        $cart->quantity += $quantity;
        $cart->save();

        return $cart;
    }

    public function deleteCart($cartId): ?Cart
    {
        $cart = Cart::find($cartId);
        if (!$cart) return null;

        $cart->delete();
        return $cart;
    }
}
