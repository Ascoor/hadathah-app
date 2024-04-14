<?php

namespace App\Http\Controllers;

use App\Models\SocialRep;
use Illuminate\Http\Request;
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
        'email' => 'nullable|email|max:255|unique:sale_reps',
        'password' => 'nullable|string|min:8',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
        'skills' => 'nullable|string',
    ]);

    $socialRep = SocialRep::create([
        'name' => $validatedData['name'],
        'phone' => $validatedData['phone'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
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

     public function update(Request $request, $id)
     {
         $socialRep = SocialRep::findOrFail($id);
 
         $validatedData = $request->validate([
             'name' => 'required|string|max:255',
             'phone' => 'required|string|max:255|unique:sale_reps,phone,' . $socialRep->id,
             'email' => 'nullable|email|max:255|unique:sale_reps,email,' . $socialRep->id,
             'password' => 'nullable|string|min:8',
             'image' => 'nullable|string|max:255',
             'skills' => 'nullable|string',
         ]);
 
         $socialRep->update($validatedData);
 
         return response()->json($socialRep);
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
