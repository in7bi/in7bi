<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\WebSettings;

class ApiWebSettingsController extends Controller
{
    public function index()
    {
        $settings = WebSettings::first();

        if (! $settings) {
            return response()->json(['message' => 'Web settings not found'], 404);
        }

        return response()->json($settings);
    }
}
