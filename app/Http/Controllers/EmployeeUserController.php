<?php

namespace App\Http\Controllers;

use App\Models\Designer;
use App\Models\SaleRep;
use App\Models\SocialRep;
use Illuminate\Http\Request;

class EmployeeUserController extends Controller
{
   // TODO employees index
   public function index()
   {
       // Fetch all employees with their user and role details
       $designers = Designer::with('user.role')->get();
       $saleReps = SaleRep::with('user.role')->get();
       $socialReps = SocialRep::with('user.role')->get();
   
       // Create a unified list of all employee users
       $employeeUsers = collect($designers)
           ->merge($saleReps)
           ->merge($socialReps)
           ->map(function ($employee) {
               return [
                'id' => $employee->user->id,
                   'name' => $employee->user->name,
                   'email' => $employee->user->email,
                   'role' => $employee->user->role->arabic_name,

                   'phone' => $employee->phone,
                   'created_at' => $employee->created_at,
                   'image' => $employee->image // Assuming the image attribute is correctly set up
               ];
           });
   
       return response()->json([
           'employeeUsers' => $employeeUsers
       ]);
      
   }
}   