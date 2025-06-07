<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;

class SocialController extends Controller
{
    // Create new or update existing social record (anggap hanya 1 record)
    public function createOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'facebook'  => 'nullable|url|max:255',
            'twitter'   => 'nullable|url|max:255',
            'linkedin'  => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
        ]);

        // Ambil record pertama, atau buat baru
        $social = Social::first();

        if ($social) {
            $social->update($validated);
        } else {
            $social = Social::create($validated);
        }

        return response()->json($social);
    }

    // Optional: method untuk mengambil data social (read)
    public function show()
    {
        $social = Social::first();

        if (! $social) {
            return response()->json(['message' => 'Social data not found'], 404);
        }

        return response()->json($social);
    }
}
