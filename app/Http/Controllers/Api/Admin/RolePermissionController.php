<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    // -------- Role CRUD --------

    public function getRoles()
    {
        return response()->json(Role::all());
    }

    public function createRole(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        $role = Role::create([
            'name' => $validated['name'],
            'guard_name' => 'web',
        ]);

        return response()->json($role, 201);
    }

    public function updateRole(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name,'.$role->id,
        ]);

        $role->name = $validated['name'];
        $role->save();

        return response()->json($role);
    }

    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json(['message' => 'Role deleted successfully.']);
    }

    // -------- Permission CRUD --------

    public function getPermissions()
    {
        return response()->json(Permission::all());
    }

    public function createPermission(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        $permission = Permission::create([
            'name' => $validated['name'],
            'guard_name' => 'web',
        ]);

        return response()->json($permission, 201);
    }

    public function updatePermission(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|unique:permissions,name,'.$permission->id,
        ]);

        $permission->name = $validated['name'];
        $permission->save();

        return response()->json($permission);
    }

    public function deletePermission($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return response()->json(['message' => 'Permission deleted successfully.']);
    }

    // -------- Assign Role to User --------

    public function assignRoleToUser(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($validated['user_id']);
        $user->assignRole($validated['role']);

        return response()->json([
            'message' => 'Role assigned successfully.',
            'user' => $user->only(['id', 'name', 'email']),
            'role' => $validated['role'],
        ]);
    }

    // Get all users (for listing in a table)
    public function getUserRoles()
    {
        $users = User::all()->map(function ($user) {
            $roles = $user->roles->pluck('name');

            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $roles,
            ];
        });

        return response()->json($users);
    }

    // revoke role from user
    public function revokeRoleFromUser(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($validated['user_id']);
        $user->removeRole($validated['role']);

        return response()->json([
            'message' => 'Role revoked successfully.',
            'user' => $user->only(['id', 'name', 'email']),
            'role' => $validated['role'],
        ]);
    }
}
