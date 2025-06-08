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

    public function storeOrUpdate(Request $request)
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

        $settings = WebSettings::first();

        if ($settings) {
            $settings->update($validated);
        } else {
            $settings = WebSettings::create($validated);
        }

        return response()->json($settings);
    }

    public function destroy()
    {
        $settings = WebSettings::first();

        if (! $settings) {
            return response()->json(['message' => 'Settings not found'], 404);
        }

        $settings->delete();

        return response()->json(['message' => 'Settings deleted']);
    }
}
