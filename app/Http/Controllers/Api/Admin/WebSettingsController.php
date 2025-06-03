<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebSettings;

class WebSettingsController extends Controller
{
    // Tampilkan data settings (asumsi 1 row)
    public function index()
    {
        $settings = WebSettings::first();

        if (! $settings) {
            return response()->json(['message' => 'Settings not found'], 404);
        }

        return response()->json($settings);
    }

    // Simpan data settings baru (biasanya hanya sekali)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'headline'      => 'nullable|string|max:255',
            'sub_headline'  => 'nullable|string|max:255',
            'sub_materi'    => 'nullable|string',
            'siapa_kami'    => 'nullable|string',
            'visi'          => 'nullable|string',
            'misi'          => 'nullable|string',
            'phone'         => 'nullable|string|max:50',
            'email'         => 'nullable|email|max:255',
            'address'       => 'nullable|string',
        ]);

        // Cek apakah sudah ada data
        if (WebSettings::count() > 0) {
            return response()->json(['message' => 'Settings already exist'], 409);
        }

        $settings = WebSettings::create($validated);

        return response()->json($settings, 201);
    }

    // Update settings
    public function update(Request $request, $id)
    {
        $settings = WebSettings::find($id);

        if (! $settings) {
            return response()->json(['message' => 'Settings not found'], 404);
        }

        $validated = $request->validate([
            'headline'      => 'nullable|string|max:255',
            'sub_headline'  => 'nullable|string|max:255',
            'sub_materi'    => 'nullable|string',
            'siapa_kami'    => 'nullable|string',
            'visi'          => 'nullable|string',
            'misi'          => 'nullable|string',
            'phone'         => 'nullable|string|max:50',
            'email'         => 'nullable|email|max:255',
            'address'       => 'nullable|string',
        ]);

        $settings->update($validated);

        return response()->json($settings);
    }

    // Hapus settings (jika diperlukan)
    public function destroy($id)
    {
        $settings = WebSettings::find($id);

        if (! $settings) {
            return response()->json(['message' => 'Settings not found'], 404);
        }

        $settings->delete();

        return response()->json(['message' => 'Settings deleted']);
    }
}
