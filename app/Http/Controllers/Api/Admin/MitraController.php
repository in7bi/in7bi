<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MitraController extends Controller
{
    // Tampilkan semua mitra
    public function index()
    {
        return response()->json(Mitra::all());
    }

    // Tampilkan mitra berdasarkan ID
    public function show($id)
    {
        $mitra = Mitra::find($id);

        if (! $mitra) {
            return response()->json(['message' => 'Mitra not found'], 404);
        }

        return response()->json($mitra);
    }

    // Simpan mitra baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mitra_name' => 'required|string|max:255',
            'mitra_subtitle' => 'nullable|string|max:255',
            'mitra_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload logo jika ada
        if ($request->hasFile('mitra_logo')) {
            $validated['mitra_logo'] = $request->file('mitra_logo')->store('uploads/mitra', 'public');
        }

        $mitra = Mitra::create($validated);

        return response()->json($mitra, 201);
    }

    // Update mitra
    public function update(Request $request, $id)
    {
        $mitra = Mitra::find($id);

        if (! $mitra) {
            return response()->json(['message' => 'Mitra not found'], 404);
        }

        $validated = $request->validate([
            'mitra_name' => 'sometimes|required|string|max:255',
            'mitra_subtitle' => 'nullable|string|max:255',
            'mitra_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload logo baru (hapus lama jika ada)
        if ($request->hasFile('mitra_logo')) {
            if ($mitra->mitra_logo && Storage::disk('public')->exists($mitra->mitra_logo)) {
                Storage::disk('public')->delete($mitra->mitra_logo);
            }
            $validated['mitra_logo'] = $request->file('mitra_logo')->store('uploads/mitra', 'public');
        }

        $mitra->update($validated);

        return response()->json($mitra);
    }

    // Hapus mitra
    public function destroy($id)
    {
        $mitra = Mitra::find($id);

        if (! $mitra) {
            return response()->json(['message' => 'Mitra not found'], 404);
        }

        if ($mitra->mitra_logo && Storage::disk('public')->exists($mitra->mitra_logo)) {
            Storage::disk('public')->delete($mitra->mitra_logo);
        }

        $mitra->delete();

        return response()->json(['message' => 'Mitra deleted successfully']);
    }
}
