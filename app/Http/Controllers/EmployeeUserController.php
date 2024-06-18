<?php

namespace App\Http\Controllers;

use App\Models\Designer;
use App\Models\SaleRep;
use App\Models\SocialRep;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeUserController extends Controller
{
   // TODO employees index

   public function index()
    {
        // Fetch all users with their related employee details
        $users = User::with(['designer', 'saleRep', 'socialRep', 'role'])->get();

        // Create a unified list of all employee users
        $employeeUsers = $users->map(function ($user) {
            $employeeData = $user->designer ?? $user->saleRep ?? $user->socialRep;

            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role->arabic_name ?? null,
                'phone' => $employeeData->phone ?? null,
                'created_at' => $employeeData->created_at ?? $user->created_at,
                'image' => $employeeData->image ?? null, // Assuming the image attribute is correctly set up
            ];
        });

        return response()->json([
            'employeeUsers' => $employeeUsers->values() // Use values to reset keys
        ]);
    }
}