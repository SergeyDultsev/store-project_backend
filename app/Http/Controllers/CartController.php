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

    public function index(): JsonResponse
    {
        $cartData = $this->cartServices->indexCart();

        if ($cartData->isEmpty()) return $this->jsonResponse([], 404, "Cart not found");

        return $this->jsonResponse([
            'cart' => CartResource::collection($cartData),
            'meta' => [
                'current_page' => $cartData->currentPage(),
                'per_page' => $cartData->perPage(),
                'total' => $cartData->total(),
                'last_page' => $cartData->lastPage(),
            ]
        ], 200, "Successfully");
    }

    public function store($productId): JsonResponse
    {
        $cartData = $this->cartServices->addCart($productId);
        return $this->jsonResponse(['product' => new CartResource($cartData)], 201, 'Cart added successfully');
    }

    public function show()
    {
        //
    }

    public function update(CartUpdateRequests $request, $cartId): JsonResponse
    {
        $quantity = $request->input('quantity');
        $cart = $this->cartServices->updateCart($cartId, $quantity);

        if (!$cart) return $this->jsonResponse([$cart], 404, "Cart not found");
        return $this->jsonResponse(['cart' => $cart], 200, "Cart updated successfully");
    }

    public function destroy($cartId): JsonResponse
    {
        $cart = $this->cartServices->deleteCart($cartId);

        if (!$cart) return $this->jsonResponse([], 404, "Cart not found");
        return $this->jsonResponse(['cart' => $cart], 200, "Cart deleted successfully");
    }
}
