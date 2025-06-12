<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Jika email berubah, set email_verified_at ke null
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
            ],
        ]);
    }

    public function requestRoleAssignment(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        // Misalnya, kamu simpan dulu sebagai log atau kirim ke admin untuk persetujuan manual
        // Untuk demo, langsung assign role (tapi bisa kamu ubah untuk sistem persetujuan)
        $user = $request->user();
        $user->assignRole($validated['role']);

        return response()->json([
            'message' => 'Role assigned successfully.',
            'role' => $validated['role'],
        ]);
    }
}
