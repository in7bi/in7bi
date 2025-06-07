<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\Faq;

class WebFaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest()->take(5)->get();

        return response()->json([
            'data' => $faqs,
        ]);
    }
}
