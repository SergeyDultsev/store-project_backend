<?php


use App\Models\Cart;
use Ramsey\Uuid\Uuid;

class CartServices{
    public function addCart($productId): void
    {
        $cart = new Cart();
        $cart->cart_id = Uuid::uuid4()->toString();
        $cart->product_id = $productId;
        $cart->user_id = auth()->id();
        $cart->quantity = 1;
        $cart->save();
    }

    public function index(): object
    {
        return Cart::where('user_id', auth()->id())->get();
    }
}
