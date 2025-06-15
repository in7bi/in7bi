<?php

namespace App\Http\Controllers\Api\Marketplace\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\ShopDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopDetailController extends Controller
{
    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'npwp' => 'nullable|string',
        ]);
        $user = Auth::user();

        // Pastikan user punya shop
        $shop = Shop::where('user_id', $user->id)->first();

        if (!$shop) {
            return response()->json([
                'status' => false,
                'message' => 'User does not own a shop.',
            ], 404);
        }

        $shopDetail = ShopDetail::updateOrCreate(
            ['shop_id' => $shop->id],
            [
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'npwp' => $request->npwp,
                'user_id' => $user->id,
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'Shop detail saved successfully.',
            'data' => $shopDetail,
        ]);
    }

    public function show()
    {
        $user = Auth::user();

        $shop = Shop::where('user_id', $user->id)->first();

        if (!$shop) {
            return response()->json([
                'status' => false,
                'message' => 'User does not own a shop.',
            ], 404);
        }

        $shopDetail = ShopDetail::where('shop_id', $shop->id)->first();

        return response()->json([
            'status' => true,
            'data' => $shopDetail,
        ]);
    }
}
