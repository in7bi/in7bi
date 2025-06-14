<?php

namespace App\Http\Controllers\Api\Marketplace\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::with('user')->get();

        return response()->json($shops);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shop_name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $shop = Shop::create($validated);

        return response()->json($shop, 201);
    }

    public function show($id)
    {
        $shop = Shop::with('user')->findOrFail($id);

        return response()->json($shop);
    }

    public function update(Request $request, $id)
    {
        $shop = Shop::findOrFail($id);

        $validated = $request->validate([
            'shop_name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $shop->update($validated);

        return response()->json($shop);
    }

    public function destroy($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();

        return response()->json(['message' => 'Shop deleted successfully.']);
    }
}
