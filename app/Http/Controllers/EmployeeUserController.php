<?php

namespace App\Http\Controllers;

use App\Models\Designer;
use App\Models\MultiEmployee;
use App\Models\SaleRep;
use App\Models\SocialRep;
use App\Rules\PhoneNumber;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Traits\HandlesImages;
use App\Helpers\ConversionHelper;
use Illuminate\Http\JsonResponse;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class EmployeeUserController extends Controller
{
    public function index()
{
    // Fetch all employees with their user and role details
    $designers = Designer::with('user.role')->get();
    $saleReps = SaleRep::with('user.role')->get();
    $socialReps = SocialRep::with('user.role')->get();
    $multiEmployees = MultiEmployee::with('user.role')->get();

    // Create a unified list of all employee users
    $employeeUsers = collect($designers)
        ->merge($saleReps)
        ->merge($socialReps)
        ->merge($multiEmployees)
        ->map(function ($employee) {
            $position = null;

            if ($employee instanceof Designer) {
                $position = 'مصمم';
            } elseif ($employee instanceof SaleRep) {
                $position = 'مندوب مبيعات';
            } elseif ($employee instanceof SocialRep) {
                $position = 'مندوب تسويق';
            } elseif ($employee instanceof MultiEmployee) {
                $position = 'موظف إدارى';
            }

            return [
                'id' => $employee->user->id,
                'name' => $employee->user->name,
                'email' => $employee->user->email,
                'role' => $employee->user->role->arabic_name,
                'position' => $position,
                'phone' => $employee->phone,
                'covered_areas' => $employee->covered_areas,
                'skills' => $employee->skills,
                'employee_position' => $employee->employee_position,
                'created_at' => $employee->created_at,
                'image' => $employee->image
            ];
        });

    return response()->json([
        'employeeUsers' => $employeeUsers
    ]);
}


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'string', 'max:255', new PhoneNumber], // استخدام قاعدة التحقق المخصصة
            'position' => 'required|string',
            'skills' => 'nullable|string',
            'email' => 'required|string|email|max:255|unique:users',
            'employee_position' => 'nullable|string',
            'covered_areas' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
        ]);

        // Convert name to English and generate email
        $nameInEnglish = ConversionHelper::convertNameToEnglish($validatedData['name']);
        $nameParts = explode(' ', $nameInEnglish);
        $firstName = strtolower($nameParts[0]);
        $lastName = strtolower(end($nameParts));
        $email = $firstName . '.' . $lastName . '-' . strtolower($validatedData['position']) . '@hadathah.org';

        $request->merge(['email' => $email]);
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $validatedData['email'] = $email;

        // Generate password
        $defaultPasswordPart = substr($validatedData['email'], 0, 5);
        $password = $defaultPasswordPart . '@2024';

        // Create user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($password),
            'phone' => $validatedData['phone'],
            'role_id' => 2
        ]);

        // Prepare common data
        $data = [
            'user_id' => $user->id,
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
        ];

        // Save image if present
        if ($request->hasFile('image')) {
            $directory = 'public/' . strtolower(str_replace(' ', '_', $validatedData['position']));
            Storage::makeDirectory($directory);
            $imagePath = $request->file('image')->store($directory);
            $data['image'] = Storage::url($imagePath);
        }

        // Determine the correct table based on position
        switch ($validatedData['position']) {
            case 'designer':
                $data['skills'] = $validatedData['skills'];
                $employee = Designer::create($data);
                break;
            case 'sale_reps':
                $data['covered_areas'] = $validatedData['covered_areas'];
                $employee = SaleRep::create($data);
                break;
            case 'social_reps':
                $data['skills'] = $validatedData['skills'];
                $employee = SocialRep::create($data);
                break;
            case 'multi_employees':
                $data['employee_position'] = $validatedData['employee_position'];
                $employee = MultiEmployee::create($data);
                break;
        }

        return response()->json([
            'message' => ucfirst($validatedData['position']) . ' created successfully!',
            'user' => $user,
            'employee' => $employee
        ]);
    }
    
    public function updateUserEmail(Request $request, $id)
    {
        // Find the user and the related record based on the position
        $user = User::findOrFail($id);
    
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:1,2',
        ]);
    
        // Extract the first part of the email and append the domain
        $emailPrefix = explode('@', $validatedData['email'])[0];
        $validatedData['email'] = $emailPrefix . '@hadathah.org';
    
        // Data to be updated
        $data = [
            'email' => $validatedData['email'],
            'role_id' => $validatedData['role'], // assuming the column is named 'role_id'
        ];
    
        // Update the user's email and role_id
        $user->update($data);
    
        return response()->json(['message' => 'User updated successfully.']);
    }
    


    public function getEmployeesData()
    {
        $designers = Designer::all();
        $saleReps = SaleRep::all();
        $socialReps = SocialRep::all();
        $multiEmployees = MultiEmployee::all();

        return response()->json([
            'designers' => $designers,
            'saleReps' => $saleReps,
            'socialReps' => $socialReps,
            'multiEmployees' => $multiEmployees
        ]);
    }
    public function destroy($id)
    {

    // Find the user
    $user = User::findOrFail($id);

    // Delete related records in respective tables
    if ($user->designer()->exists()) {
        $user->designer()->delete();
    }
    if ($user->saleRep()->exists()) {
        $user->saleRep()->delete();
    }
    if ($user->socialRep()->exists()) {
        $user->socialRep()->delete();
    }
    if ($user->multiEmployee()->exists()) {
        $user->multiEmployee()->delete();
    }

    // Delete the user
    $user->delete();

    return response()->json(['message' => 'User and related records deleted successfully.']);

    }
}