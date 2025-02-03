<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequests;
use App\Http\Resources\ProductResource;
use CartServices;
use Symfony\Component\HttpFoundation\JsonResponse;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartServices $cartService)
    {
        $this->cartServices = $cartService;
    }

    public function store(CartRequests $request): JsonResponse
    {
        $this->cartServices->addCart($request->all());
        return $this->jsonResponse([], 201, 'Cart added successfully');
    }

    public function index(): JsonResponse
    {
        $cartData = $this->cartServices->indexCart();
        if (!$cartData->total() === 0) return $this->jsonResponse([], 404, "Cart not found");
        return $this->jsonResponse([ProductResource::collection($cartData)], 200, "Successfully");
    }

    public function update(CartRequests $request): JsonResponse
    {

    }

    public function destroy(CartRequests $request): JsonResponse
    {

    }
}
