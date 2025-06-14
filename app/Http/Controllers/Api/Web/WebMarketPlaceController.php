<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSpecs;

class WebMarketPlaceController extends Controller
{
    public function products()
    {
        $products = Product::with(['category', 'shop', 'specs'])
            ->latest()
            ->get()
            ->makeHidden(['user_id', 'shop_id', 'product_category_id']);

        return response()->json($products);
    }

    public function productDetail($id)
    {
        $product = Product::with(['category', 'shop'])->findOrFail($id);

        $specs = ProductSpecs::where('product_id', $product->id)->select('keywords', 'keywords_value')->get();

        $product->setAttribute('specs', $specs);
        $product->makeHidden(['user_id', 'shop_id', 'product_category_id']);

        return response()->json($product);
    }

    public function productSpecs($product_id)
    {
        $specs = ProductSpecs::where('product_id', $product_id)->select('keywords', 'keywords_value')->get();

        return response()->json($specs);
    }

    public function categories()
    {
        $categories = ProductCategory::select('id', 'name', 'description')->get();
        return response()->json($categories);
    }
}
