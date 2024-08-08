<?php

namespace App\Http\Controllers;

use App\Models\MultiEmployee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ConversionHelper;
use App\Models\User;

use App\Rules\PhoneNumber;
use App\Http\Controllers\Traits\HandlesImages;
use Illuminate\Support\Facades\Hash;

class MultiEmployeeController extends Controller
{  use HandlesImages;

    public function index()
    {
        $multiEmployees = MultiEmployee::all();
        return response()->json($multiEmployees);
    }

    public function create()
    {

    }

public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => ['required', 'string', 'max:255', new PhoneNumber], 
        'employee_position' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',

    ]);

    $defaultPassword = 'defaultPassword123'; 

    DB::beginTransaction();
    try {
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($defaultPassword),
            'phone' => $validatedData['phone'],
            'role_id' => 2 
        ]);

        $multiEmployee = MultiEmployee::create([
            'user_id' => $user->id,
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'employee_position' => $validatedData['employee_position'],

        ]);

        if ($request->hasFile('image')) {
            $this->handleImageUpload($request, $multiEmployee, 'public/multi-employees');
        }

        DB::commit();

        return response()->json([
            'message' => 'MultiEmployee created successfully!',
            'user' => $user,
            'multiEmployee' => $multiEmployee
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['error' => 'Failed to create MultiEmployee and user.'], 500);
    }
}

public function update(Request $request, MultiEmployee $multiEmployee): JsonResponse
{
    $validatedData = $request->validate([
        'phone' => [
            'required', 
            'string', 
            'max:255',
            new PhoneNumber($multiEmployee->id) 
        ],
        'employee_position' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
    ]);

    DB::beginTransaction();
    try {
        $multiEmployee->update(Arr::except($validatedData, ['image']));

        if ($request->hasFile('image')) {
            $this->handleImageUpdate($request, $multiEmployee);
        }

        DB::commit();
        return response()->json(['message' => 'Multi employee updated successfully.', 'multiEmployee' => $multiEmployee]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => 'Failed to update multi employee', 'error' => $e->getMessage()], 500);
    }
}
    public function destroy($id): JsonResponse
    {
        DB::beginTransaction();

        try {
            $multiEmployee = MultiEmployee::findOrFail($id);

            $user = User::findOrFail($multiEmployee->user_id);

            if ($multiEmployee->image) {
                $oldImagePath = str_replace('/storage', 'public', $multiEmployee->image);
                if (Storage::exists($oldImagePath)) {
                    $deleted = Storage::delete($oldImagePath);
                    if (!$deleted) {
                        DB::rollBack();
                        return response()->json(['message' => 'Error deleting the image.'], 500);
                    }
                }
            }

            $multiEmployee->delete();

            $user->delete();

            DB::commit();

            return response()->json(['message' => 'multi employee, associated user, and image deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error occurred while deleting sale Rep and user: ' . $e->getMessage()], 500);
        }
        }

private function handleImageUpload(Request $request, MultiEmployee $multiEmployee, $path)
{
    $imagePath = $request->file('image')->store($path);
    $multiEmployee->image = Storage::url($imagePath);
    $multiEmployee->save();
}

private function handleImageUpdate(Request $request, MultiEmployee $multiEmployee)
{
    $oldImagePath = $multiEmployee->image ? str_replace('/storage', 'public', $multiEmployee->image) : null;
    $imagePath = $request->file('image')->store('public/multi-employees');
    $multiEmployee->image = Storage::url($imagePath);
    $multiEmployee->save();
    if ($oldImagePath) {
        Storage::delete($oldImagePath);
    }
}

private function generateEmail($name) {
    $nameInEnglish = strtolower(preg_replace('/\s+/', '.', $name));
    return $nameInEnglish . '-multiEmployee@hadathah.org';
}

}