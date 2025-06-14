<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSpecs;
use Illuminate\Http\Request;

class WebMarketPlaceController extends Controller
{
    /**
     * Menampilkan list produk untuk publik
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
     * Menampilkan detail produk untuk publik
     */
    public function productDetail($id)
    {
        $product = Product::with(['category', 'shop'])
            ->findOrFail($id)
            ->makeHidden(['user_id', 'shop_id', 'product_category_id']);

        return response()->json($product);
    }

    /**
     * Menampilkan spesifikasi produk berdasarkan ID produk
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
