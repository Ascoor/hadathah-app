<?php

namespace App\Http\Controllers;

use App\Models\Designer;
use App\Models\MultiEmployee;
use App\Models\SaleRep;
use App\Models\SocialRep;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Helpers\ConversionHelper;
use Illuminate\Support\Facades\Storage;

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
            ->merge($multiEmployees)
            ->merge($socialReps)
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
                    'position' => $position ?: $employee->position, // Use predefined position or fallback to employee's position attribute
                    'phone' => $employee->phone,
                    'covered_areas' => $employee->covered_areas,
                    'skills' => $employee->skills,
                    'created_at' => $employee->created_at,
                    'image' => $employee->image // Assuming the image attribute is correctly set up
                ];
            });
 
        return response()->json([
            'employeeUsers' => $employeeUsers
        ]);
    }public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'position' => 'required|string',
            'role' => 'required|integer', // تأكد من أن هذا حقل integer
            'skills' => 'nullable|string',
            'covered_areas' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
        ]);
    
        // تحويل الاسم إلى الإنجليزية
        $nameInEnglish = ConversionHelper::convertNameToEnglish($validatedData['name']);
    
        // توليد البريد الإلكتروني بناءً على الاسم باللغة الإنجليزية
        $email = strtolower(str_replace(' ', '', $nameInEnglish)) . '@hadathah.org'; 
        $password = Hash::make('password123'); // أو قم بتوليد كلمة مرور قوية
    
        // إنشاء المستخدم في جدول users
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $email,
            'password' => $password,
            'role_id' => $validatedData['role'], // تأكد من أن هذا حقل integer
        ]);
    
        // إعداد البيانات المشتركة
        $data = [
            'user_id' => $user->id,
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'image' => $validatedData['image'] ?? null,
        ];
    
        // حفظ الصورة إذا كانت موجودة
        if ($request->hasFile('image')) {
            $directory = 'public/' . strtolower(str_replace(' ', '_', $validatedData['position']));
            Storage::makeDirectory($directory); 
            $imagePath = $request->file('image')->store($directory);
            $data['image'] = Storage::url($imagePath);
        }
    
        // تحديد الجدول المناسب بناءً على position
        switch ($validatedData['position']) {
            case 'designers':
                $data['skills'] = $validatedData['skills'];
                Designer::create($data);
                break;
            case 'sale_reps':
                $data['covered_areas'] = $validatedData['covered_areas'];
                SaleRep::create($data);
                break;
            case 'social_reps':
                $data['skills'] = $validatedData['skills'];
                SocialRep::create($data);
                break;
            case 'multi_employees':
                $data['position'] = $validatedData['position']; // إضافة هذا السطر لضمان وجود الحقل في البيانات المرسلة
                MultiEmployee::create($data);
                break;
        }
    
        return response()->json(['message' => 'Employee created successfully']);
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
