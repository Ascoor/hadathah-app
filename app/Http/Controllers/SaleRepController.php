<?php

namespace App\Http\Controllers;

use App\Models\SaleRep;
use Illuminate\Http\Request;
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
        'email' => 'nullable|email|max:255|unique:sale_reps',
        'password' => 'nullable|string|min:8',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
        'covered_areas' => 'required|string',
    ]);

    $saleRep = SaleRep::create([
        'name' => $validatedData['name'],
        'phone' => $validatedData['phone'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'covered_areas' => $validatedData['covered_areas'],
    ]);

    if ($request->hasFile('image')) {
        // Ensure the directory exists
        $directory = 'public/sale_reps';
        Storage::makeDirectory($directory); // This will create the directory if it doesn't exist

        // Store the image in the specified directory
        $imagePath = $request->file('image')->store($directory);

        // Save the URL to the image in the database
        $saleRep->image = Storage::url($imagePath);
        $saleRep->save(); // Don't forget to save the update
    }

    return response()->json($saleRep, 201);
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

     public function update(Request $request, $id)
     {
         $saleRep = SaleRep::findOrFail($id);
 
         $validatedData = $request->validate([
             'name' => 'required|string|max:255',
             'phone' => 'required|string|max:255|unique:sale_reps,phone,' . $saleRep->id,
             'email' => 'nullable|email|max:255|unique:sale_reps,email,' . $saleRep->id,
             'password' => 'nullable|string|min:8',
             'image' => 'nullable|string|max:255',
             'covered_areas' => 'required|string',
         ]);
 
         $saleRep->update($validatedData);
 
         return response()->json($saleRep);
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
