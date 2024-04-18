<?php

namespace App\Http\Controllers;

use App\Models\SocialRep;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SocialRepController extends Controller
{
    public function index()
    {
        $socialReps = SocialRep::all();
        return response()->json($socialReps);
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
        'phone' => 'required|string|max:255|unique:sale_reps',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024', // حجم الصورة بكيلوبايت
        'skills' => 'nullable|string',
    ]);

    $socialRep = SocialRep::create([
        'name' => $validatedData['name'],
        'phone' => $validatedData['phone'],
                
        'skills' => $validatedData['skills'],
    ]);

    if ($request->hasFile('image')) {
        // Ensure the directory exists
        $directory = 'public/sale_reps';
        Storage::makeDirectory($directory); // This will create the directory if it doesn't exist

        // Store the image in the specified directory
        $imagePath = $request->file('image')->store($directory);

        // Save the URL to the image in the database
        $socialRep->image = Storage::url($imagePath);
        $socialRep->save(); // Don't forget to save the update
    }

    return response()->json($socialRep, 201);
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
    
    public function update(Request $request, SocialRep $socialRep)
    {
         $validatedData = $request->validate([
             'name' => 'required|string|max:255',
             'phone' => 'required|string|max:255|unique:sale_reps,phone,' . $socialRep->id,
             'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024', // حجم الصورة بكيلوبايت
             'skills' => 'nullable|string',
         ]);
 
    
    // Use Arr::except to remove the 'image' key from the validated data array before updating the socialRep
    $dataWithoutImage = Arr::except($validatedData, ['image']);
    
    // Update social rep with the validated data (except the image)
    $socialRep->update($dataWithoutImage);

    if ($request->hasFile('image')) {
        try {
            DB::beginTransaction();
    
            // Capture the old image path before updating
            $oldImagePath = $socialRep->image ? str_replace('/storage', 'public', $socialRep->image) : null;

            // Store the new image and update the socialRep's image attribute
            $imagePath = $request->file('image')->store('public/social-reps');
            $socialRep->image = Storage::url($imagePath);
    
            // Save the social rep with the new image path
            $socialRep->save();
    
            // Delete the old image after the new image has been saved successfully
            if ($oldImagePath) {
                Storage::delete($oldImagePath);
            }
    
            DB::commit();
    
            return response()->json(['message' => 'socialRep updated successfully.', 'socialRep' => $socialRep]);
        } catch (\Exception $e) {
            // If there's an error, rollback the transaction
            DB::rollBack();
            return response()->json(['message' => 'Failed to update the social rep image', 'error' => $e->getMessage()], 500);
        }
    } else {
        // If no image is part of the request, the other updates have already been saved
        return response()->json(['message' => 'social rep updated successfully without image update.', 'socialRep' => $socialRep]);
    }
}

 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     public function destroy($id)
     {
         $socialRep = SocialRep::findOrFail($id);
         $socialRep->delete();
         
         return response()->json(['message' => 'Sale rep deleted successfully']);
     }
}
