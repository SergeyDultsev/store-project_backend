<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequests;
use App\Http\Resources\ProductResource;
use App\Services\ProductServices;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends Controller
{
    protected ProductServices $productService;

    public function __construct(ProductServices $productService)
    {
        $this->productService = $productService;
    }

    public function index(): JsonResponse
    {
        $productData = $this->productService->indexProduct();

        if ($productData->isEmpty()) return $this->jsonResponse([], 404, "Product not found");

        return $this->jsonResponse(
            [
                'products' => ProductResource::collection($productData),
                'meta' => [
                    'current_page' => $productData->currentPage(),
                    'per_page' => $productData->perPage(),
                    'total' => $productData->total(),
                    'last_page' => $productData->lastPage(),
                ]
            ], 200, "Successfully");
    }

    public function store(ProductRequests $request): JsonResponse
    {
        $this->productService->createProduct($request->all());

        return $this->jsonResponse([], 201, 'Product created successfully.');
    }

    public function show(int $productId): JsonResponse
    {
        $product = $this->productService->showProduct($productId);

        if (!$product) return $this->jsonResponse([], 404, "Product not found");

        return $this->jsonResponse(new ProductResource($product), 200, "Successfully");

    }

    public function update(ProductRequests $request, int $productId): JsonResponse
    {
        $product = $this->productService->updateProduct($productId, $request->all());

        if (!$product) return $this->jsonResponse([], 404, "Product not found");

        return $this->jsonResponse([], 200, 'Product updated successfully.');
    }

    public function destroy(int $productId): JsonResponse
    {
        $this->productService->deleteProduct($productId);

        return $this->jsonResponse([], 200, 'Product deleted successfully.');
    }
}
