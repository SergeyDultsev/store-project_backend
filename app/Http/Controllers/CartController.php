<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartUpdateRequests;
use App\Http\Resources\CartResource;
use App\Services\CartServices;
use Symfony\Component\HttpFoundation\JsonResponse;

class CartController extends Controller
{
    protected CartServices $cartServices;

    public function __construct(CartServices $cartServices)
    {
        $this->cartServices = $cartServices;
    }

    public function store(int $productId): JsonResponse
    {
        $this->cartServices->addCart($productId);
        return $this->jsonResponse([], 201, 'Cart added successfully');
    }

    public function show()
    {
        //
    }

    public function index(): JsonResponse
    {
        $cartData = $this->cartServices->indexCart();

        if ($cartData->isEmpty()) return $this->jsonResponse([], 404, "Cart not found");

        return $this->jsonResponse([CartResource::collection($cartData)], 200, "Successfully");
    }

    public function update(CartUpdateRequests $request, int $cartId): JsonResponse
    {
        $quantity = $request->input('quantity');
        $cart = $this->cartServices->updateCart($cartId, $quantity);

        if (!$cart) return $this->jsonResponse([], 404, "Cart not found");
        return $this->jsonResponse(['cart' => $cart], 200, "Cart updated successfully");
    }

    public function destroy($cartId): JsonResponse
    {
        $cart = $this->cartServices->deleteCart($cartId);

        if (!$cart) return $this->jsonResponse([], 404, "Cart not found");
        return $this->jsonResponse(['cart' => $cart], 200, "Cart deleted successfully");
    }
}
