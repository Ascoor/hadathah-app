<?php

namespace App\Http\Controllers;

use App\Mail\ActivationEmail;
use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
class AuthController extends Controller
{
    public function register(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);
    
    $activationCode = Str::random(30); // Generate a random activation code


    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'role_id' => 5, // تعيين الدور بقيمة 5 بشكل افتراضي
        'activation_code' => $activationCode, // حفظ رمز التفعيل
    ]);

    // Sending activation email
    Mail::to($user->email)->send(new ActivationEmail($user));

    return response(['message' => 'success']);
}
public function activateAccount($code)
{
    $user = User::where('activation_code', $code)->first();

    if (!$user) {
        return response(['message' => 'Invalid activation code'], 404);
    }

    $user->activation_code = null;
    $user->is_active = true; // Make sure to add is_active to the fillable array if used
    $user->save();


    // Redirect to a specific URL in the frontend
    return redirect()->away('https://app.hadathah.org/done-activation');

}
public function login(Request $request)
{
    $request->validate([
        'email' => 'email|required',
        'password' => 'required'
    ]);

    // Check if the email exists and if the account is activated
    $user = User::with('role')  // جلب المستخدم مع دوره
              ->where('email', $request->email)
              ->whereNull('activation_code')
              ->first();

    if (!$user) {
        return response()->json(['message' => 'هذا البريد ليس مسجل كمستخدم أو لم يتم تفعيل الحساب بعد'], 404);
    }

    // Attempt to authenticate with the provided credentials
    if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
        return response()->json(['message' => 'هناك خطأ في كلمة المرور أعد إدخال كلمة المرور وحاول مرة أخرى'], 401);
    }

    // Create access token for the authenticated user
    $accessToken = auth()->user()->createToken('authToken')->accessToken;

    // Include the role name in the response
    $roleName = auth()->user()->role ? auth()->user()->role->name : 'No Role Assigned';

    return response([
        'user' => auth()->user(),
        'role' => $roleName,  // إضافة اسم الدور للاستجابة
        'access_token' => $accessToken
    ]);
}



    public function logout(Request $request)
    {
        // Assuming you're storing tokens in the "personal_access_tokens" table
        $request->user()->token()->revoke();
        return response(['message' => 'You have been successfully logged out!'], 200);
    }
    public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['message' => 'لم يتم العثور على مستخدم بهذا البريد الإلكتروني.'], 404);
    }

    $token = Str::random(60);
    $expiresAt = now()->addHour(); // تعيين صلاحية الرمز إلى ساعة واحدة
    $user->update(['reset_token' => $token, 'reset_token_expires_at' => $expiresAt]);

    $resetUrl = "https://app.hadathah.org/reset-password?token=$token";

    Mail::to($user->email)->send(new ResetPasswordMail($resetUrl));

    return response()->json(['message' => 'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني.']);
}
public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = User::where('reset_token', $request->token)
                ->where('reset_token_expires_at', '>', now())
                ->first();

    if (!$user) {
        return response()->json(['message' => 'رمز إعادة تعيين كلمة المرور غير صالح أو منتهي.'], 400);
    }

    $user->password = Hash::make($request->password);
    $user->reset_token = null;
    $user->reset_token_expires_at = null;
    $user->save();

    return response()->json(['message' => 'تم إعادة تعيين كلمة المرور بنجاح.']);
}

}
