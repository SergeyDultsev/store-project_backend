<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Ramsey\Uuid\Uuid;

class CartServices{
    public function indexCart(): LengthAwarePaginator
    {
        return Cart::with('product')
            ->where('user_id', auth()->id())
            ->paginate(100);
    }

    public function addCart($productId): object
    {
        $cartItem = Cart::where('product_id', $productId)
            ->where('user_id', auth()->id())
            ->first();

        if($cartItem){
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            $cart = new Cart();
            $cart->cart_id = Uuid::uuid4()->toString();
            $cart->product_id = $productId;
            $cart->user_id = auth()->id();
            $cart->quantity = 1;
            $cart->save();
        }

        return  Cart::with('product')
            ->where('product_id', $productId)
            ->where('user_id', auth()->id())
            ->first();;
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
        $cart->delete();
        return $cart;
    }
}
