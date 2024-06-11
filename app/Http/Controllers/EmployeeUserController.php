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
       $designers = Designer::with(['user.role'])->get();
       $saleReps = SaleRep::with(['user.role'])->get();
       $socialReps = SocialRep::with(['user.role'])->get();
   
       $employeeUsers = [
           'designers' => $designers->map(function ($designer) {
               return [
                   'name' => $designer->user->name,
                   'email' => $designer->user->email,
                   'role' => $designer->user->role->name
               ];
           }),
           'saleReps' => $saleReps->map(function ($saleRep) {
               return [
                   'name' => $saleRep->user->name,
                   'email' => $saleRep->user->email,
                   'role' => $saleRep->user->role->name
               ];
           }),
           'socialReps' => $socialReps->map(function ($socialRep) {
               return [
                   'name' => $socialRep->user->name,
                   'email' => $socialRep->user->email,
                   'role' => $socialRep->user->role->name
               ];
           }),
       ];
   
       return response()->json($employeeUsers);
   }
}   