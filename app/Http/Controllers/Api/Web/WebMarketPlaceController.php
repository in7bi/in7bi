<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSpecs;

class WebMarketPlaceController extends Controller
{
    /**
     * Menampilkan semua produk (untuk publik)
     */
    public function products()
    {
        $products = Product::with(['category', 'shop'])
            ->latest()
            ->get()
            ->makeHidden(['user_id', 'shop_id', 'product_category_id']);

        return response()->json($products);
    }

    /**
     * Menampilkan detail satu produk (termasuk spesifikasi)
     */
    public function productDetail($id)
    {
        $product = Product::with(['category', 'shop'])->findOrFail($id);

        $specs = ProductSpecs::where('product_id', $product->id)
            ->select('keywords', 'keywords_value')
            ->get();

        $product->setAttribute('specs', $specs);
        $product->makeHidden(['user_id', 'shop_id', 'product_category_id']);

        return response()->json($product);
    }

    /**
     * Menampilkan spesifikasi produk (opsional, jika frontend ingin endpoint terpisah)
     */
    public function productSpecs($product_id)
    {
        $specs = ProductSpecs::where('product_id', $product_id)
            ->select('keywords', 'keywords_value')
            ->get();

        return response()->json($specs);
    }

    /**
     * Menampilkan semua kategori produk
     */
    public function categories()
    {
        $categories = ProductCategory::select('id', 'name', 'description')->get();
        return response()->json($categories);
    }
}
