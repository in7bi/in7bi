<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSpecs;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;

class WebMarketPlaceController extends Controller
{
    public function products(): JsonResponse
    {
        $products = Product::with(['category', 'shop', 'specs'])->latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Product list fetched successfully.',
            'data' => ProductResource::collection($products),
        ]);
    }

    public function productDetail($id): JsonResponse
    {
        $product = Product::with(['category', 'shop', 'specs'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Product detail fetched successfully.',
            'data' => new ProductResource($product),
        ]);
    }

    public function productSpecs($product_id): JsonResponse
    {
        $specs = ProductSpecs::where('product_id', $product_id)
            ->select('keywords', 'keywords_value')
            ->get()
            ->map(function ($item) {
                return [
                    'key' => $item->keywords,
                    'value' => $item->keywords_value,
                ];
            });

        return response()->json([
            'status' => true,
            'message' => 'Product specs fetched successfully.',
            'data' => $specs,
        ]);
    }

    public function categories(): JsonResponse
    {
        $categories = ProductCategory::select('id', 'name', 'description')->get();

        return response()->json([
            'status' => true,
            'message' => 'Product categories fetched successfully.',
            'data' => $categories,
        ]);
    }
}
