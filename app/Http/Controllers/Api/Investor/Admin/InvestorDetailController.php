<?php

namespace App\Http\Controllers\Api\Investor\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvestorDetail;
use Illuminate\Support\Facades\Auth;

class InvestorDetailController extends Controller
{
    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'address' => 'required|string',
            'nationality' => 'required|string',
            'identification_number' => 'required|string|max:16',
            'npwp' => 'nullable|string',
        ]);

        $user = Auth::user();

        $investorDetail = InvestorDetail::updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $request->phone,
                'address' => $request->address,
                'nationality' => $request->nationality,
                'identification_number' => $request->identification_number,
                'npwp' => $request->npwp,
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'Investor detail saved successfully.',
            'data' => $investorDetail,
        ]);
    }

    public function show()
    {
        $user = Auth::user();

        $investorDetail = InvestorDetail::where('user_id', $user->id)->first();

        if (!$investorDetail) {
            return response()->json([
                'status' => false,
                'message' => 'Investor detail not found.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $investorDetail,
        ]);
    }
}
