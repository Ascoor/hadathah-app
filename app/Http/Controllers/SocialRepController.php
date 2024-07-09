<?php

namespace App\Http\Controllers;

use App\Models\SocialRep;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Traits\HandlesImages;
use App\Helpers\ConversionHelper;
use Illuminate\Http\JsonResponse;

class SocialRepController extends Controller
{
    use HandlesImages;
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
            'phone' => 'required|string|max:11|unique:social_reps',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024', // حجم الصورة بكيلوبايت
            'skills' => 'nullable|string',
        ]);

        // Convert name to English if it is in Arabic
        $nameInEnglish = ConversionHelper::convertNameToEnglish($validatedData['name']);

        // Generate email
        $nameParts = explode(' ', $nameInEnglish);
        $firstName = strtolower($nameParts[0]);
        $lastName = strtolower(end($nameParts));
        $email = $firstName . '.' . $lastName . '-socialRep@hadathah.org';

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

        // Create socialRep
        $socialRep = SocialRep::create([
            'user_id' => $user->id,
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'skills' => $validatedData['skills'],
        ]);

        if ($request->hasFile('image')) {
            $this->handleImageUpload($request, $socialRep, 'public/social-reps');
        }

        return response()->json([
            'message' => 'SocialRep created successfully!',
            'user' => $user,
            'socialRep' => $socialRep
        ]);
    }

    public function update(Request $request, SocialRep $socialRep): JsonResponse
    {
        $validatedData = $request->validate([
            'phone' => 'required|string|max:255|unique:social_reps,phone,' . $socialRep->id,
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

                return response()->json(['message' => 'SocialRep updated successfully.', 'socialRep' => $socialRep]);
            } catch (\Exception $e) {
                // If there's an error, rollback the transaction
                DB::rollBack();
                return response()->json(['message' => 'Failed to update the social rep image', 'error' => $e->getMessage()], 500);
            }
        } else {
            // If no image is part of the request, the other updates have already been saved
            return response()->json(['message' => 'Social rep updated successfully without image update.', 'socialRep' => $socialRep]);
        }
    }


    public function destroy($id): JsonResponse
    {
        DB::beginTransaction();

        try {
            $socialRep = SocialRep::findOrFail($id);

            // Get the associated user
            $user = User::findOrFail($socialRep->user_id);

            // Delete the socialRep's image if it exists
            if ($socialRep->image) {
                $oldImagePath = str_replace('/storage', 'public', $socialRep->image);
                if (Storage::exists($oldImagePath)) {
                    $deleted = Storage::delete($oldImagePath);
                    if (!$deleted) {
                        DB::rollBack();
                        return response()->json(['message' => 'Error deleting the image.'], 500);
                    }
                }
            }

            // Delete the socialRep
            $socialRep->delete();

            // Delete the associated user
            $user->delete();

            DB::commit();

            return response()->json(['message' => 'SocialRep, associated user, and image deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error occurred while deleting socialRep and user: ' . $e->getMessage()], 500);
        }
    }
}
