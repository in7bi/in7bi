<?php

namespace App\Http\Controllers\Api\Marketplace\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductSpecs;
use Illuminate\Http\Request;

class ProductSpecsController extends Controller
{
    public function index()
    {
        $specs = ProductSpecs::with(['product', 'shop'])->get();

        return response()->json($specs);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'keywords' => 'required|string|max:255',
            'keywords_value' => 'required|string|max:255',
            'shop_id' => 'required|exists:shops,id',
        ]);

        $spec = ProductSpecs::create($validated);

        return response()->json($spec, 201);
    }

    public function show($id)
    {
        $spec = ProductSpecs::with(['product', 'shop'])->findOrFail($id);

        return response()->json($spec);
    }

    public function update(Request $request, $id)
    {
        $spec = ProductSpecs::findOrFail($id);

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'keywords' => 'required|string|max:255',
            'keywords_value' => 'required|string|max:255',
            'shop_id' => 'required|exists:shops,id',
        ]);

        $spec->update($validated);

        return response()->json($spec);
    }

    public function destroy($id)
    {
        $spec = ProductSpecs::findOrFail($id);
        $spec->delete();

        return response()->json(['message' => 'Specification deleted successfully.']);
    }
}
