<?php

namespace App\Http\Controllers;

use App\Models\MultiEmployee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MultiEmployeeController extends Controller
{
    

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
        'phone' => 'required|string|max:255|unique:multi_employees',
               'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
        'position' => 'required|string',
    ]);

    $multiEmployee = new MultiEmployee();
    $multiEmployee->name = $validatedData['name'];
    $multiEmployee->phone = $validatedData['phone'];
    $multiEmployee->position = $validatedData['position'];

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('public/multi-employees');
        $multiEmployee->image = Storage::url($imagePath);
    }

    $multiEmployee->save();

    return response()->json(['message' => 'multiEmployee created successfully.', 'multiEmployee' => $multiEmployee]);
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
    
    
    public function update(Request $request, MultiEmployee $multiEmployee)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
                'name' => 'required|string|max:255',
    'phone' => 'required|string|max:255|unique:multi_employees',
    'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
    'position' => 'required|string',
    ]);
    
    // Use Arr::except to remove the 'image' key from the validated data array before updating the multiEmployee
    $dataWithoutImage = Arr::except($validatedData, ['image']);
    
    // Update multiEmployee with the validated data (except the image)
    $multiEmployee->update($dataWithoutImage);

    if ($request->hasFile('image')) {
        try {
            DB::beginTransaction();
    
            // Capture the old image path before updating
            $oldImagePath = $multiEmployee->image ? str_replace('/storage', 'public', $multiEmployee->image) : null;

            // Store the new image and update the multiEmployee's image attribute
            $imagePath = $request->file('image')->store('public/multi-employees');
            $multiEmployee->image = Storage::url($imagePath);
    
            // Save the multiEmployee with the new image path
            $multiEmployee->save();
    
            // Delete the old image after the new image has been saved successfully
            if ($oldImagePath) {
                Storage::delete($oldImagePath);
            }
    
            DB::commit();
    
            return response()->json(['message' => 'multiEmployee updated successfully.', 'multiEmployee' => $multiEmployee]);
        } catch (\Exception $e) {
            // If there's an error, rollback the transaction
            DB::rollBack();
            return response()->json(['message' => 'Failed to update the multiEmployee image', 'error' => $e->getMessage()], 500);
        }
    } else {
        // If no image is part of the request, the other updates have already been saved
        return response()->json(['message' => 'multiEmployee updated successfully without image update.', 'multiEmployee' => $multiEmployee]);
    }
}
    /**
     * get Sale Rep Offers Controller
     *
     * @param  int  $multiEmployeeId
     * @return \Illuminate\Http\Response
     */
  


     public function destroy($id): JsonResponse
     {
         $multiEmployee = MultiEmployee::findOrFail($id);
     
         // Attempt to delete the associated image if it exists
         if ($multiEmployee->image) {
             $oldImagePath = str_replace('/storage', 'public', $multiEmployee->image);
             if (Storage::exists($oldImagePath)) {
                 $deleted = Storage::delete($oldImagePath);
                 if (!$deleted) {
                     return response()->json(['message' => 'Error deleting the image.'], 500);
                 }
             }
         }
     
         // Delete the multiEmployee record
         $multiEmployee->delete();
     
         return response()->json(['message' => 'Sale rep and associated image deleted successfully.']);
     }
     
}
