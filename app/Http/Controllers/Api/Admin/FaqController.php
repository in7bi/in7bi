<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        return response()->json(Faq::all());
    }

    public function show($id)
    {
        $faq = Faq::find($id);

        if (! $faq) {
            return response()->json(['message' => 'FAQ not found'], 404);
        }

        return response()->json($faq);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq = Faq::create($data);

        return response()->json($faq, 201);
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::find($id);

        if (! $faq) {
            return response()->json(['message' => 'FAQ not found'], 404);
        }

        $data = $request->validate([
            'question' => 'sometimes|required|string|max:255',
            'answer' => 'sometimes|required|string',
        ]);

        $faq->update($data);

        return response()->json($faq);
    }

    public function destroy($id)
    {
        $faq = Faq::find($id);

        if (! $faq) {
            return response()->json(['message' => 'FAQ not found'], 404);
        }

        $faq->delete();

        return response()->json(['message' => 'FAQ deleted']);
    }
}
