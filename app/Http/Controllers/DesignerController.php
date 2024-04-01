<?php

namespace App\Http\Controllers;

use App\Models\Designer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DesignerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Designer::all());
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
            'phone' => 'required|string|min:10|max:11|unique:designers', // Corrected this line
            'email' => 'nullable|email|max:255|unique:designers', // Ensure the table name is correct here as well
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
            'skills' => 'required|string',
        ]);

        $designer = Designer::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'skills' => $validatedData['skills'],
        ]);

        if ($request->hasFile('image')) {
            // Ensure the directory exists
            $directory = 'public/designers';
            Storage::makeDirectory($directory); // This will create the directory if it doesn't exist

            // Store the image in the specified directory
            $imagePath = $request->file('image')->store($directory);

            // Save the URL to the image in the database
            $designer->image = Storage::url($imagePath);
            $designer->save(); // Don't forget to save the update
        }

        return response()->json($designer, 201);
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
        $designer = Designer::findOrFail($id); // التأكد من وجود المصمم
    
        // التحقق من البيانات المرسلة
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' =>  'required|string|max:255|unique:designers,phone,' . $designer->id,
            'email' => 'nullable|email|max:255|unique:designers,email,' . $designer->id,

            'image' => 'nullable|string|max:255',
            'skills' => 'required|string',
        ]);

     
    // تحديث بيانات المصمم
    $designer->update($validatedData);

    // إرجاع البيانات مع رمز حالة HTTP 200
    return response()->json($designer, 200);
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
