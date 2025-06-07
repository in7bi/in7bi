<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function createOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
        ]);

        $social = Social::first();

        if ($social) {
            $social->update($validated);
        } else {
            $social = Social::create($validated);
        }

        return response()->json($social);
    }

    public function show()
    {
        $social = Social::first();

        if (! $social) {
            return response()->json(['message' => 'Social data not found'], 404);
        }

        return response()->json($social);
    }
}
