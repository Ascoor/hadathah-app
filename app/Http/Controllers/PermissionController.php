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
    // Fetch user permissions
    $user = User::findOrFail($userId);
    $permissions = $user->permissions->groupBy('section');
    return response()->json($permissions);
}


public function updateUserPermissions(Request $request, $userId)
{
    $user = User::findOrFail($userId);
    $permissionsInput = $request->input('permissions'); // تأكد من استقبال الصلاحيات بشكل صحيح
    
    // مسح جميع الصلاحيات السابقة للمستخدم
    $user->permissions()->detach();

    // إضافة الصلاحيات الجديدة أو تحديثها
    foreach ($permissionsInput as $perm) {
        $user->permissions()->attach($perm['permission_id'], ['enabled' => $perm['enabled']]);
    }

    return response()->json(['message' => 'Permissions updated successfully!']);
}

}