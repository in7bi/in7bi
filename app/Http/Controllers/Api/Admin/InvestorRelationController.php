<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvestorRelation;
use Illuminate\Http\Request;

class InvestorRelationController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $data = InvestorRelation::all();

        return response()->json($data);
    }

    // Tampilkan data berdasarkan ID
    public function show($id)
    {
        $item = InvestorRelation::find($id);
        if (! $item) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json($item);
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'headline' => 'required|string|max:255',
            'sub_headline' => 'required|string|max:255',
            'materi' => 'required|string',
        ]);

        $item = InvestorRelation::create($validated);

        return response()->json($item, 201);
    }

    // Update data berdasarkan ID
    public function update(Request $request, $id)
    {
        $item = InvestorRelation::find($id);
        if (! $item) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $validated = $request->validate([
            'headline' => 'sometimes|required|string|max:255',
            'sub_headline' => 'sometimes|required|string|max:255',
            'materi' => 'sometimes|required|string',
        ]);

        $item->update($validated);

        return response()->json($item);
    }

    // Hapus data berdasarkan ID
    public function destroy($id)
    {
        $item = InvestorRelation::find($id);
        if (! $item) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Data deleted']);
    }
}
