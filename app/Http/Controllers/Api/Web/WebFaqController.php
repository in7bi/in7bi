<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class WebFaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest()->take(10)->get();

        return response()->json([
            'data' => $faqs,
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $faqs = Faq::where('question', 'like', '%' . $query . '%')
            ->orWhere('answer', 'like', '%' . $query . '%')
            ->latest()
            ->get();

        return response()->json([
            'data' => $faqs,
        ]);
    }
}
