<?php

namespace App\Http\Controllers\Api\Marketplace\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'user', 'shop'])->get();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_sku' => 'required|string|unique:products,product_sku',
            'product_name' => 'required|string|max:255',
            'product_category_id' => 'required|exists:product_categories,id',
            'product_description' => 'nullable|string',
            'product_price' => 'required|numeric|min:0',
            'product_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'user_id' => 'required|exists:users,id',
            'shop_id' => 'nullable|exists:shops,id',
        ]);

        if ($request->hasFile('product_photo')) {
            $validated['product_photo'] = $request->file('product_photo')->store('products', 'public');
        }

        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = Product::with(['category', 'user', 'shop'])->findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'product_sku' => 'required|string|unique:products,product_sku,' . $product->id,
            'product_name' => 'required|string|max:255',
            'product_category_id' => 'required|exists:product_categories,id',
            'product_description' => 'nullable|string',
            'product_price' => 'required|numeric|min:0',
            'product_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'user_id' => 'required|exists:users,id',
            'shop_id' => 'nullable|exists:shops,id',

        ]);

        // Hapus foto lama jika ada
        if ($request->hasFile('product_photo')) {
            if ($product->product_photo && Storage::disk('public')->exists($product->product_photo)) {
                Storage::disk('public')->delete($product->product_photo);
            }
            $validated['product_photo'] = $request->file('product_photo')->store('products', 'public');
        }

        $product->update($validated);
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus foto jika ada
        if ($product->product_photo && Storage::disk('public')->exists($product->product_photo)) {
            Storage::disk('public')->delete($product->product_photo);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully.']);
    }
}
