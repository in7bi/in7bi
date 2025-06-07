<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\Social;

class WebSocialController extends Controller
{
    public function index()
    {
        $social = Social::first();

        if (! $social) {
            return response()->json(['message' => 'Social settings not found'], 404);
        }

        return response()->json($social);
    }
}
