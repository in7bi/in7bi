<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\RoleRequest;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return response()->json([
            'message' => 'Profile updated successfully.',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'email_verified' => !is_null($user->email_verified_at),
                'roles' => $user->getRoleNames(), // Tampilkan role aktif
            ],
        ]);
    }

    public function requestRoleAssignment(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        $existing = RoleRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return response()->json(['message' => 'You already have a pending request.'], 409);
        }

        $requestRole = RoleRequest::create([
            'user_id' => $user->id,
            'requested_role' => $validated['role'],
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Role request submitted.',
            'request' => $requestRole,
        ]);
    }
}
