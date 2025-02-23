<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Ramsey\Uuid\Uuid;

class OrderServices{
    public function indexOrder(): LengthAwarePaginator
    {
        return Order::with('product')
            ->where('user_id', auth()->id())
            ->paginate(100);
    }

    public function createOrder(array $data): array
    {
        $orderData = [];

        foreach ($data['order'] as $product) {
            $cart = Cart::where("cart_id", $product['cart_id'])->first();

            if(!$cart) continue;

            $order = new Order();
            $order->order_id = Uuid::uuid4()->toString();
            $order->user_id = auth()->id();
            $order->product_id = $product['product_id'];
            $order->quantity = $product['quantity'];
            $order->price = $product['product_price'];
            $order->save();

            $cart->delete();

            $orderData[] = Order::with('product')->find($order->order_id);
        }

        return $orderData;
    }
}
