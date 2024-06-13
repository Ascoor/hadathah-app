<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    
//     public function __construct()
//     {
//         $this->middleware('auth');
//     }


public function index()
{
    // Fetch all permissions organized by section
    $permissions = Permission::all()->groupBy('section');
    return response()->json($permissions);
}

public function getUserPermissions($userId)
{
    // Fetch user-specific permissions organized by section
    $user = User::findOrFail($userId);
    $permissions = $user->permissions()->with('permission')->get()->groupBy('permission.section');

    $organizedPermissions = [];
    foreach ($permissions as $section => $perms) {
        foreach ($perms as $perm) {
            $organizedPermissions[$section][] = [
                'name' => $perm->permission->name,
                'enabled' => $perm->enabled
            ];
        }
    }

    return response()->json($organizedPermissions);
}

public function updateUserPermissions(Request $request, $userId)
{
    $user = User::findOrFail($userId);
    $permissionsInput = $request->all();

    foreach ($permissionsInput as $section => $perms) {
        foreach ($perms as $perm) {
            $permission = Permission::where('section', $section)
                                    ->where('name', $perm['name'])
                                    ->firstOrFail();

            // Update or create user permission records
            $user->permissions()->updateOrCreate(
                ['permission_id' => $permission->id],
                ['enabled' => $perm['enabled']]
            );
        }
    }

    return response()->json(['message' => 'Permissions updated successfully!']);
}
}