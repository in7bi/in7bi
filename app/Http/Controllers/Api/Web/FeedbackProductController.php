<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\FeedbackProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeedbackProductController extends Controller
{
    public function index()
    {
        $feedback = FeedbackProduct::with(['product', 'user'])->latest()->get();
        return response()->json($feedback);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'description' => 'nullable|string',
            'feedback_category' => 'required|in:Shipping,Services,Product',
            'upload_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('upload_photo')) {
            $path = $request->file('upload_photo')->store('feedback_photos', 'public');
            $validated['upload_photo'] = $path;
        }

        $feedback = FeedbackProduct::create($validated);
        return response()->json($feedback, 201);
    }

    public function show($id)
    {
        $feedback = FeedbackProduct::with(['product', 'user'])->findOrFail($id);
        return response()->json($feedback);
    }

    public function destroy($id)
    {
        $feedback = FeedbackProduct::findOrFail($id);

        if ($feedback->upload_photo) {
            Storage::disk('public')->delete($feedback->upload_photo);
        }

        $feedback->delete();

        return response()->json(['message' => 'Feedback deleted successfully.']);
    }
}
