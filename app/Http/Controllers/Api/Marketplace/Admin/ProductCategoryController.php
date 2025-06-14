<?php

namespace App\Http\Controllers\Api\Marketplace\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
            'description' => 'nullable|string',
        ]);

        $category = ProductCategory::create($validated);

        return response()->json($category, 201);
    }

    public function show($id)
    {
        $category = ProductCategory::findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return response()->json($category);
    }

    public function destroy($id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Product category deleted.']);
    }
}
