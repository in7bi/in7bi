<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebSettings;
use Illuminate\Http\Request;

class WebSettingsController extends Controller
{
    public function index()
    {
        $settings = WebSettings::first();

        if (! $settings) {
            return response()->json(['message' => 'Settings not found'], 404);
        }

        return response()->json($settings);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'headline' => 'nullable|string|max:255',
            'sub_headline' => 'nullable|string|max:255',
            'sub_materi' => 'nullable|string',
            'siapa_kami' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ]);

        if (WebSettings::count() > 0) {
            return response()->json(['message' => 'Settings already exist'], 409);
        }

        $settings = WebSettings::create($validated);

        return response()->json($settings, 201);
    }

    public function update(Request $request, $id)
    {
        $settings = WebSettings::find($id);

        if (! $settings) {
            return response()->json(['message' => 'Settings not found'], 404);
        }

        $validated = $request->validate([
            'headline' => 'nullable|string|max:255',
            'sub_headline' => 'nullable|string|max:255',
            'sub_materi' => 'nullable|string',
            'siapa_kami' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ]);

        $settings->update($validated);

        return response()->json($settings);
    }

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
