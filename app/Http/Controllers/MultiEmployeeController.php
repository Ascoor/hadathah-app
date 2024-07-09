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

use App\Http\Controllers\Traits\HandlesImages;
class MultiEmployeeController extends Controller
{  use HandlesImages;
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index()
    {
        $multiEmployees = MultiEmployee::all();
        return response()->json($multiEmployees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:11',
            'employee_position' => 'required|string',
                 'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
        ]);
        $nameInEnglish = ConversionHelper::convertNameToEnglish($validatedData['name']);
        $nameParts = explode(' ', $nameInEnglish);
        $firstName = strtolower($nameParts[0]);
        $lastName = strtolower(end($nameParts));
        $email = $firstName . '.' . $lastName . '-multiEmployee@hadathah.org';
      
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
          
          $multiEmployee = MultiEmployee::create([
          'user_id' => $user->id,
          'name' => $validatedData['name'],
          'phone' => $validatedData['phone'],
          'employee_position' => $validatedData['employee_position'],
          
          
              ]);
      
          if ($request->hasFile('image')) {
              $this->handleImageUpload($request, $multiEmployee, 'public/multi-employees');
          }
      
      
          return response()->json([
              'message' => 'multi Employees created successfully!',
              'user' => $user,
              'multiEmployee' => $multiEmployee
          ]);}
          public function update(Request $request, MultiEmployee $multiEmployee): JsonResponse
          {
              $validatedData = $request->validate([
                 'phone' => 'required|string|max:11|unique:multi_employees,phone,' . $multiEmployee->id,
                  'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024', // حجم الصورة بكيلوبايت
                  'employee_position' => 'nullable|string',
              ]);
      
              // Use Arr::except to remove the 'image' key from the validated data array before updating the multiEmployee
              $dataWithoutImage = Arr::except($validatedData, ['image']);
      
              // Update multi Employee with the validated data (except the image)
              $multiEmployee->update($dataWithoutImage);
      
              if ($request->hasFile('image')) {
                  try {
                      DB::beginTransaction();
      
                      // Capture the old image path before updating
                      $oldImagePath = $multiEmployee->image ? str_replace('/storage', 'public', $multiEmployee->image) : null;
      
                      // Store the new image and update the multiEmployee's image attribute
                      $imagePath = $request->file('image')->store('public/multi-employees');
                      $multiEmployee->image = Storage::url($imagePath);
      
                      // Save the multi Employee with the new image path
                      $multiEmployee->save();
      
                      // Delete the old image after the new image has been saved successfully
                      if ($oldImagePath) {
                          Storage::delete($oldImagePath);
                      }
      
                      DB::commit();
      
                      return response()->json(['message' => 'multi employee updated successfully.', 'multi Employee' => $multiEmployee]);
                  } catch (\Exception $e) {
                      // If there's an error, rollback the transaction
                      DB::rollBack();
                      return response()->json(['message' => 'Failed to update the multi Employee image', 'error' => $e->getMessage()], 500);
                  }
              } else {
                  // If no image is part of the request, the other updates have already been saved
                  return response()->json(['message' => 'multi Employee updated successfully without image update.', 'multiEmployee' => $multiEmployee]);
              }
          }
    
    public function destroy($id): JsonResponse
    {
        DB::beginTransaction();
    
        try {
            $multiEmployee = MultiEmployee::findOrFail($id);
    
            // Get the associated user
            $user = User::findOrFail($multiEmployee->user_id);
    
            // Delete the multiEmployee's image if it exists
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
    
            // Delete the multiEmployee
            $multiEmployee->delete();
    
            // Delete the associated user
            $user->delete();
    
            DB::commit();
    
            return response()->json(['message' => 'multi employee, associated user, and image deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error occurred while deleting sale Rep and user: ' . $e->getMessage()], 500);
        }
        }
}
