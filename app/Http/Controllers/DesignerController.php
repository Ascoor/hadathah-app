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
            'email_external' => 'required|string|email|max:255'
        ]);

        $nameInEnglish = ConversionHelper::convertNameToEnglish($validatedData['name']);

        $email = strtolower(str_replace(' ', '', $nameInEnglish)) . '-designer@hadathah.org';

        $request->merge(['email' => $email]);
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $validatedData['email'] = $email;

        $defaultPasswordPart = substr($validatedData['email'], 0, 5); 
        $password = $defaultPasswordPart . '@2024'; 

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($password), 
            'phone' => $validatedData['phone'],
            'role_id' => 2
        ]);

        $designer = Designer::create([
            'user_id' => $user->id,
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'skills' => $validatedData['skills'],
            'email_external' => $validatedData['email_external']
        ]);

        if ($request->hasFile('image')) {
            $directory = 'public/designers';
            Storage::makeDirectory($directory); 
            $imagePath = $request->file('image')->store($directory);
            $designer->image = Storage::url($imagePath);
            $designer->save(); 
        }

        // Add the user to Mail-in-a-Box
        $added = $this->mailinaboxService->addUser($user->email, $password);

        if (!$added) {
            // Handle error
            return response()->json(['error' => 'Failed to add user to Mail-in-a-Box'], 500);
        }

        // Generate reset password link
        $token = Str::random(60);
        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => Hash::make($token),
            'created_at' => now()
        ]);

        $resetUrl = url('/reset-password?token=' . $token . '&email=' . urlencode($user->email));

        // Send activation email
        Mail::to($designer->email_external)->send(new ResetPasswordMail($resetUrl));

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

public function update(Request $request, Designer $designer)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:255|unique:designers,phone,' . $designer->id,
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024', 
        'skills' => 'nullable|string',
        'password' => 'nullable|string|min:6', 
    ]);

    $dataWithoutImageAndPassword = Arr::except($validatedData, ['image', 'password']);

    $designer->update($dataWithoutImageAndPassword);

    if (!empty($validatedData['password'])) {
        $user = $designer->user; 
        $user->password = Hash::make($validatedData['password']);
        $user->save();
    }

    if ($request->hasFile('image')) {
        try {
            DB::beginTransaction();

            $oldImagePath = $designer->image ? str_replace('/storage', 'public', $designer->image) : null;

            $imagePath = $request->file('image')->store('public/designers');
            $designer->image = Storage::url($imagePath);

            $designer->save();

            if ($oldImagePath) {
                Storage::delete($oldImagePath);
            }

            DB::commit();

            return response()->json(['message' => 'Designer updated successfully.', 'designer' => $designer]);
        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json(['message' => 'Failed to update the Designer image', 'error' => $e->getMessage()], 500);
        }
    } else {

        return response()->json(['message' => 'Designer updated successfully without image update.', 'designer' => $designer]);
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