<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Include validation for name
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        
        $user = User::create([
            'name' => $validatedData['name'], // Save the name
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);


        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
    
        // Check if the email exists in the database
        $user = \App\Models\User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'هذا البريد ليس مسجل كمستخدم'], 404);
        }
    
        // Attempt to authenticate with the provided credentials
        if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['message' => 'هناك خطأ في كلمة المرور أعد إدخال كلمة المرور وحاول مرة أخرى'], 401);
        }
    
        // Create access token for the authenticated user
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
    
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }
    

    public function logout(Request $request)
    {
        // Assuming you're storing tokens in the "personal_access_tokens" table
        $request->user()->token()->revoke();
        return response(['message' => 'You have been successfully logged out!'], 200);
    }
}
