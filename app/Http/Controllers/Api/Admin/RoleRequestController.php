<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleRequest;

class RoleRequestController extends Controller
{
    public function index()
    {
        return RoleRequest::with('user')->latest()->get();
    }

    public function approve($id)
    {
        $request = RoleRequest::findOrFail($id);

        if ($request->status !== 'pending') {
            return response()->json(['message' => 'Request already processed.'], 400);
        }

        $user = $request->user;

        // Assign role
        $user->assignRole($request->requested_role);

        // Mark as approved
        $request->update(['status' => 'approved']);

        return response()->json([
            'message' => 'Role approved and assigned.',
            'user' => $user->only(['id', 'name', 'email']),
            'role' => $request->requested_role,
        ]);
    }

    public function reject($id)
    {
        $request = RoleRequest::findOrFail($id);

        if ($request->status !== 'pending') {
            return response()->json(['message' => 'Request already processed.'], 400);
        }

        $request->update(['status' => 'rejected']);

        return response()->json(['message' => 'Role request rejected.']);
    }
}
