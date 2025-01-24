<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class ProductServices
{
    public function indexProduct(): LengthAwarePaginator
    {
        return Product::paginate(10);
    }

    public function createProduct(array $data): void
    {
        $product = new Product();
        $product->product_id = Uuid::uuid4()->toString();
        $product->product_name = $data['name'];
        $product->product_price = $data['price'];

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $product->image = $data['image']->store('product_images', 'public');
        }

        $product->save();
    }

    public function showProduct(int $productId): ?Product
    {
        return Product::find($productId);
    }

    public function updateProduct(int $productId, array $data): ?Product
    {
        $product = Product::find($productId);
        if (!$product) return null;
        $product->product_name = $data['name'];
        $product->product_price = $data['price'];

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $product->image = $data['image']->store('product_image', 'public');
        }

        $product->save();
        return $product;
    }

    public function deleteProduct(int $productId): void
    {
        $product = Product::find($productId);
        if (!$product) return;
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();
    }
}
