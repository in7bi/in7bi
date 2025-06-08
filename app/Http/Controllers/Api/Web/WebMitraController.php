<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\Mitra;

class WebMitraController extends Controller
{
    public function index()
    {
        $mitras = Mitra::latest()->get();

        return response()->json($mitras);
    }

    public function show($id)
    {
        $mitra = Mitra::find($id);

        if (! $mitra) {
            return response()->json(['message' => 'Mitra not found'], 404);
        }

        return response()->json($mitra);
    }
}
