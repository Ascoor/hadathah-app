<?php

namespace App\Http\Controllers;

use App\Models\SaleRep;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Traits\HandlesImages;
use App\Helpers\ConversionHelper;
use App\Models\User;

class SaleRepController extends Controller
{
   
        use HandlesImages;
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
  // Convert name to English if it is in Arabic
  $nameInEnglish = ConversionHelper::convertNameToEnglish($validatedData['name']);
  $nameParts = explode(' ', $nameInEnglish);
  $firstName = strtolower($nameParts[0]);
  $lastName = strtolower(end($nameParts));
  $email = $firstName . '.' . $lastName . '-saleRep@hadathah.org';

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
    
    $saleRep = SaleRep::create([
    'user_id' => $user->id,
    'name' => $validatedData['name'],
    'phone' => $validatedData['phone'],
        'covered_areas' => $validatedData['covered_areas'],
        ]);

    if ($request->hasFile('image')) {
        $this->handleImageUpload($request, $saleRep, 'public/sale-reps');
    }


    return response()->json([
        'message' => 'SaleRep created successfully!',
        'user' => $user,
        'saleRep' => $saleRep
    ]);}

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
    
     public function update(Request $request, SaleRep $saleRep): JsonResponse
     {
         $validatedData = $request->validate([
            'phone' => 'required|string|max:255|unique:sale_reps,phone,' . $saleRep->id,
             'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024', // حجم الصورة بكيلوبايت
             'covered_areas' => 'nullable|string',
         ]);
 
         // Use Arr::except to remove the 'image' key from the validated data array before updating the saleRep
         $dataWithoutImage = Arr::except($validatedData, ['image']);
 
         // Update sale rep with the validated data (except the image)
         $saleRep->update($dataWithoutImage);
 
         if ($request->hasFile('image')) {
             try {
                 DB::beginTransaction();
 
                 // Capture the old image path before updating
                 $oldImagePath = $saleRep->image ? str_replace('/storage', 'public', $saleRep->image) : null;
 
                 // Store the new image and update the saleRep's image attribute
                 $imagePath = $request->file('image')->store('public/sale-reps');
                 $saleRep->image = Storage::url($imagePath);
 
                 // Save the sale rep with the new image path
                 $saleRep->save();
 
                 // Delete the old image after the new image has been saved successfully
                 if ($oldImagePath) {
                     Storage::delete($oldImagePath);
                 }
 
                 DB::commit();
 
                 return response()->json(['message' => 'Sale Rep updated successfully.', 'saleRep' => $saleRep]);
             } catch (\Exception $e) {
                 // If there's an error, rollback the transaction
                 DB::rollBack();
                 return response()->json(['message' => 'Failed to update the sale rep image', 'error' => $e->getMessage()], 500);
             }
         } else {
             // If no image is part of the request, the other updates have already been saved
             return response()->json(['message' => 'sale rep updated successfully without image update.', 'saleRep' => $saleRep]);
         }
     }
 
    /**
     * get Sale Rep Offers Controller
     *
     * @param  int  $saleRepId
     * @return \Illuminate\Http\Response
     */
    public function getOffersBySaleRep($saleRepId)
{
    $saleRep = SaleRep::findOrFail($saleRepId);
    $offers = $saleRep->offers()->get();
    return response()->json($offers);
}






public function destroy($id): JsonResponse
{
    DB::beginTransaction();

    try {
        $saleRep = SaleRep::findOrFail($id);

        // Get the associated user
        $user = User::findOrFail($saleRep->user_id);

        // Delete the saleRep's image if it exists
        if ($saleRep->image) {
            $oldImagePath = str_replace('/storage', 'public', $saleRep->image);
            if (Storage::exists($oldImagePath)) {
                $deleted = Storage::delete($oldImagePath);
                if (!$deleted) {
                    DB::rollBack();
                    return response()->json(['message' => 'Error deleting the image.'], 500);
                }
            }
        }

        // Delete the saleRep
        $saleRep->delete();

        // Delete the associated user
        $user->delete();

        DB::commit();

        return response()->json(['message' => 'Sale Rep, associated user, and image deleted successfully.']);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => 'Error occurred while deleting sale Rep and user: ' . $e->getMessage()], 500);
    }
    }
     
}
