<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    // Tampilkan semua service categories
    public function index()
    {
        $categories = ServiceCategory::all();

        return response()->json($categories);
    }

    // Tampilkan detail berdasarkan ID
    public function show($id)
    {
        $category = ServiceCategory::find($id);

        if (! $category) {
            return response()->json(['message' => 'Service Category not found'], 404);
        }

        return response()->json($category);
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $category = ServiceCategory::create($validated);

        return response()->json($category, 201);
    }

    // Update data berdasarkan ID
    public function update(Request $request, $id)
    {
        $category = ServiceCategory::find($id);

        if (! $category) {
            return response()->json(['message' => 'Service Category not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
        ]);

        $category->update($validated);

        return response()->json($category);
    }

    // Hapus data berdasarkan ID
    public function destroy($id)
    {
        $category = ServiceCategory::find($id);

        if (! $category) {
            return response()->json(['message' => 'Service Category not found'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Service Category deleted successfully']);
    }
}
