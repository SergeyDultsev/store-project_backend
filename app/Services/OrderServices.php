<?php

namespace App\Services;

use App\Models\Order;

class OrderServices{
    public function indexOrder(): LengthAwarePaginator
    {
        return Order::paginate(100);
    }

    public function createOrder(array $data): void
    {

    }
}
