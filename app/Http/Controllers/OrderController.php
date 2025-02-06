<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Services\OrderServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected OrderServices $orderService;

    public function __construct(OrderServices $orderService){
        $this->orderService = $orderService;
    }

    public function index(): JsonResponse
    {
        $orderData = $this->orderService->indexOrder();

        if($orderData->isEmpty()) return $this->jsonResponse([], 404, 'Order Not Found');

        return $this->jsonResponse(
            [
                'order' => OrderResource::collection($orderData),
                'meta' => [
                    'current_page' => $orderData->currentPage(),
                    'per_page' => $orderData->perPage(),
                    'total' => $orderData->total(),
                    'last_page' => $orderData->lastPage(),
                ]
            ], 200, 'Order Not Found');
    }

    public function store(Request $request): JsonResponse
    {

    }
}
