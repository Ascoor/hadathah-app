<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
           $roles = Role::all();
           return response()->json($roles);

    }

    public function store(Request $request)
    {
        $role = Role::create($request->all());
        return response()->json($role);
    }
 
    public function getRolePermissions($roleId)
    {

        $permissions = Role::find($roleId)->permissions;
        return response()->json($permissions);
    }
}
