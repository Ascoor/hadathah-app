<?php

namespace App\Http\Controllers;

use App\Models\Designer;
use App\Models\Password;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DesignerController extends Controller
{
    public function index()
    {
        $designers = Designer::all();
        return response()->json($designers);
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
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:designers',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
            'skills' => 'nullable|string',
        ]);
    
        // Generate a secure random password
        $password = Str::random(12); // Assuming you are using the Laravel helper Str::random
    
        // Store the password in the passwords table
        $passwordEntry = Password::create(['password' => bcrypt($password)]);
    
        // Create the designer with the password_id
        $designer = Designer::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'password_id' => $passwordEntry->id, // Store the password id in the designer record
            'skills' => $validatedData['skills'],
        ]);
    
        // Handle file upload if it exists
        if ($request->hasFile('image')) {
            $directory = 'public/designers';
            Storage::makeDirectory($directory); // Ensure the directory exists
            $imagePath = $request->file('image')->store($directory);
            $designer->image = Storage::url($imagePath);
            $designer->save(); // Save the update
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, Designer $designer)
    {
         $validatedData = $request->validate([
             'name' => 'required|string|max:255',
             'phone' => 'required|string|max:255|unique:designers,phone,' . $designer->id,
             'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024', // حجم الصورة بكيلوبايت
             'skills' => 'nullable|string',
         ]);
 
    
    // Use Arr::except to remove the 'image' key from the validated data array before updating the designer
    $dataWithoutImage = Arr::except($validatedData, ['image']);
    
    // Update Designer with the validated data (except the image)
    $designer->update($dataWithoutImage);

    if ($request->hasFile('image')) {
        try {
            DB::beginTransaction();
    
            // Capture the old image path before updating
            $oldImagePath = $designer->image ? str_replace('/storage', 'public', $designer->image) : null;

            // Store the new image and update the designer's image attribute
            $imagePath = $request->file('image')->store('public/designers');
            $designer->image = Storage::url($imagePath);
    
            // Save the Designer with the new image path
            $designer->save();
    
            // Delete the old image after the new image has been saved successfully
            if ($oldImagePath) {
                Storage::delete($oldImagePath);
            }
    
            DB::commit();
    
            return response()->json(['message' => 'designer updated successfully.', 'designer' => $designer]);
        } catch (\Exception $e) {
            // If there's an error, rollback the transaction
            DB::rollBack();
            return response()->json(['message' => 'Failed to update the Designer image', 'error' => $e->getMessage()], 500);
        }
    } else {
        // If no image is part of the request, the other updates have already been saved
        return response()->json(['message' => 'Designer updated successfully without image update.', 'designer' => $designer]);
    }
}

 

    /**
     * Search the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     public function destroy($id): JsonResponse
     {
         $designer = Designer::findOrFail($id);
     
         // Attempt to delete the associated image if it exists
         if ($designer->image) {
             $oldImagePath = str_replace('/storage', 'public', $designer->image);
             if (Storage::exists($oldImagePath)) {
                 $deleted = Storage::delete($oldImagePath);
                 if (!$deleted) {
                     return response()->json(['message' => 'Error deleting the image.'], 500);
                 }
             }
         }
     
         // Delete the designer$designer record
         $designer->delete();
     
         return response()->json(['message' => 'Designer and associated image deleted successfully.']);
     }
}
