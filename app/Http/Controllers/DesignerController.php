<?php

namespace App\Http\Controllers;

use App\Models\Designer;
use App\Helpers\ConversionHelper;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\ResetPasswordMail;
use App\Mail\MailinaboxService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class DesignerController extends Controller
{
    protected $mailinaboxService;

    public function __construct(MailinaboxService $mailinaboxService)
    {
        $this->mailinaboxService = $mailinaboxService;
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:designers',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
            'skills' => 'nullable|string',
        ]);
    
        // Convert name to English if it is in Arabic
        $nameInEnglish = ConversionHelper::convertNameToEnglish($validatedData['name']);
    
        // Generate email
        $nameParts = explode(' ', $nameInEnglish);
        $firstName = strtolower($nameParts[0]);
        $lastName = strtolower(end($nameParts));
        $email = $firstName . '.' . $lastName . '-designer@hadathah.org';
    
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
    
        // Create designer
        $designer = Designer::create([
            'user_id' => $user->id,
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'skills' => $validatedData['skills'],
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $directory = 'public/designers';
            Storage::makeDirectory($directory);
            $imagePath = $request->file('image')->store($directory);
            $designer->image = Storage::url($imagePath);
            $designer->save();
        }
    
        return response()->json([
            'message' => 'Designer created successfully!',
            'user' => $user,
            'designer' => $designer
        ]);
    }
    


    public function index()
    {
        $designers = Designer::all();
        return response()->json($designers);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }
public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'phone' => 'required|string|max:255|unique:designers,phone,' . $id,
        'skills' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
    ]);

    $designer = Designer::findOrFail($id);
    $user = $designer->user;

    $designer->update([
        'phone' => $validatedData['phone'],
        'skills' => $validatedData['skills'],
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        $directory = 'public/designers';
        Storage::makeDirectory($directory);
        $imagePath = $request->file('image')->store($directory);
        $designer->image = Storage::url($imagePath);
        $designer->save();
    }

    return response()->json([
        'message' => 'Designer updated successfully!',
        'designer' => $designer
    ]);
}


public function destroy($id): JsonResponse
{
    DB::beginTransaction();

    try {
        $designer = Designer::findOrFail($id);

        // Get the associated user
        $user = User::findOrFail($designer->user_id);

        // Delete the designer's image if it exists
        if ($designer->image) {
            $oldImagePath = str_replace('/storage', 'public', $designer->image);
            if (Storage::exists($oldImagePath)) {
                $deleted = Storage::delete($oldImagePath);
                if (!$deleted) {
                    DB::rollBack();
                    return response()->json(['message' => 'Error deleting the image.'], 500);
                }
            }
        }

        // Delete the designer
        $designer->delete();

        // Delete the associated user
        $user->delete();

        DB::commit();

        return response()->json(['message' => 'Designer, associated user, and image deleted successfully.']);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => 'Error occurred while deleting designer and user: ' . $e->getMessage()], 500);
    }
}
}

     public function destroy($id): JsonResponse
     {
         $designer = Designer::findOrFail($id);

         if ($designer->image) {
             $oldImagePath = str_replace('/storage', 'public', $designer->image);
             if (Storage::exists($oldImagePath)) {
                 $deleted = Storage::delete($oldImagePath);
                 if (!$deleted) {
                     return response()->json(['message' => 'Error deleting the image.'], 500);
                 }
             }
         }

         $designer->delete();

         return response()->json(['message' => 'Designer and associated image deleted successfully.']);
     }
    }