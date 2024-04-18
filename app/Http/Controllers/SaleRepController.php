<?php

namespace App\Http\Controllers;

use App\Models\SaleRep;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SaleRepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index()
    {
        $saleReps = SaleRep::all();
        return response()->json($saleReps);
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
               'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
        'covered_areas' => 'required|string',
    ]);

    $saleRep = new SaleRep();
    $saleRep->name = $validatedData['name'];
    $saleRep->phone = $validatedData['phone'];
    $saleRep->covered_areas = $validatedData['covered_areas'];

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('public/sale-reps');
        $saleRep->image = Storage::url($imagePath);
    }

    $saleRep->save();

    return response()->json(['message' => 'saleRep created successfully.', 'saleRep' => $saleRep]);
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
    
    
    public function update(Request $request, SaleRep $saleRep)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
                'name' => 'required|string|max:255',
    'phone' => 'required|string|max:255|unique:sale_reps',
    'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
    'covered_areas' => 'required|string',
    ]);
    
    // Use Arr::except to remove the 'image' key from the validated data array before updating the saleRep
    $dataWithoutImage = Arr::except($validatedData, ['image']);
    
    // Update saleRep with the validated data (except the image)
    $saleRep->update($dataWithoutImage);

    if ($request->hasFile('image')) {
        try {
            DB::beginTransaction();
    
            // Capture the old image path before updating
            $oldImagePath = $saleRep->image ? str_replace('/storage', 'public', $saleRep->image) : null;

            // Store the new image and update the saleRep's image attribute
            $imagePath = $request->file('image')->store('public/sale-rep');
            $saleRep->image = Storage::url($imagePath);
    
            // Save the saleRep with the new image path
            $saleRep->save();
    
            // Delete the old image after the new image has been saved successfully
            if ($oldImagePath) {
                Storage::delete($oldImagePath);
            }
    
            DB::commit();
    
            return response()->json(['message' => 'saleRep updated successfully.', 'saleRep' => $saleRep]);
        } catch (\Exception $e) {
            // If there's an error, rollback the transaction
            DB::rollBack();
            return response()->json(['message' => 'Failed to update the saleRep image', 'error' => $e->getMessage()], 500);
        }
    } else {
        // If no image is part of the request, the other updates have already been saved
        return response()->json(['message' => 'saleRep updated successfully without image update.', 'saleRep' => $saleRep]);
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
         $saleRep = SaleRep::findOrFail($id);
         $saleRep->delete();
         
         return response()->json(['message' => 'Sale rep deleted successfully']);
     }
}
