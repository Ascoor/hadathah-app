<?php

namespace App\Http\Controllers;

use App\Models\Designer;
use App\Models\MultiEmployee;
use App\Models\SaleRep;
use App\Models\SocialRep;

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
            'phone' => 'required|string|max:255',
            'position' => 'required|string',
            'skills' => 'nullable|string',
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

    public function update(Request $request, $id)
    {
        // Find the user and the related record based on the position
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'phone' => 'required|string|max:255|unique:' . strtolower($user->position) . ',phone,' . $id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
            'skills' => 'nullable|string',
            'covered_areas' => 'nullable|string',
            'employee_position' => 'nullable|string',
            'position' => 'required|string',
        ]);

        // Common data to be updated
        $data = [
            'phone' => $validatedData['phone'],
        ];

        // Handle the image update
        if ($request->hasFile('image')) {
            $directory = 'public/' . strtolower(str_replace(' ', '_', $user->position));
            Storage::makeDirectory($directory);
            $imagePath = $request->file('image')->store($directory);
            $data['image'] = Storage::url($imagePath);

            // Delete the old image if it exists
            $oldImagePath = $user->image ? str_replace('/storage', 'public', $user->image) : null;
            if ($oldImagePath && Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
        }

        // Find and update the record in the appropriate table based on position
        switch ($user->position) {
            case 'designer':
                $record = Designer::where('user_id', $user->id)->firstOrFail();
                $data['skills'] = $validatedData['skills'];
                $record->update($data);
                break;
            case 'sale_reps':
                $record = SaleRep::where('user_id', $user->id)->firstOrFail();
                $data['covered_areas'] = $validatedData['covered_areas'];
                $record->update($data);
                break;
            case 'social_reps':
                $record = SocialRep::where('user_id', $user->id)->firstOrFail();
                $data['skills'] = $validatedData['skills'];
                $record->update($data);
                break;
            case 'multi_employees':
                $record = MultiEmployee::where('user_id', $user->id)->firstOrFail();
                $data['employee_position'] = $validatedData['employee_position'];
                $record->update($data);
                break;
        }

        return response()->json(['message' => ucfirst($user->position) . ' updated successfully.']);
    }
    public function destroy($id): JsonResponse
{
    DB::beginTransaction();

    try {
        $user = User::findOrFail($id);

        // تحديد المنصب بناءً على السجلات المرتبطة
        $position = null;
        $employee = null;

        if ($employee = Designer::where('user_id', $user->id)->first()) {
            $position = 'مصمم';
        } elseif ($employee = SaleRep::where('user_id', $user->id)->first()) {
            $position = 'مندوب مبيعات';
        } elseif ($employee = SocialRep::where('user_id', $user->id)->first()) {
            $position = 'مندوب تسويق';
        } elseif ($employee = MultiEmployee::where('user_id', $user->id)->first()) {
            $position = 'موظف إدارى';
        } else {
            throw new \Exception('Invalid position or no employee record found');
        }

        // حذف صورة الموظف إذا كانت موجودة
        if ($employee->image) {
            $oldImagePath = str_replace('/storage', 'public', $employee->image);
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
        }

        // حذف سجل الموظف
        $employee->delete();

        // حذف المستخدم المرتبط
        $user->delete();

        DB::commit();

        return response()->json(['message' => ucfirst($position) . ', associated user, and image deleted successfully.']);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => 'Error occurred while deleting employee and user: ' . $e->getMessage()], 500);
    }
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
}