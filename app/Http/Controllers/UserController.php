<?php

namespace App\Http\Controllers;

use App\Models\Designer;
use App\Models\SaleRep;
use App\Models\SocialRep;
use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
class UserController extends Controller
{

    public function index()
    {
        // جلب جميع المستخدمين مع العلاقات المرتبطة بهم
        $users = User::with(['permissions', 'role', 'designer', 'saleRep', 'socialRep'])->get();

        return response()->json($users);
    }
    
    public function store(Request $request)
    {
        // Validate and create the user
        $user = User::create($request->all());

        // Add the user to Mail-in-a-Box
        $this->addUserToMailinabox($user);

        return response()->json($user, 201);
    }

    private function addUserToMailinabox(User $user)
    {
        $client = new Client([
            'base_uri' => 'https://mail.hadathah.org/admin',
            'auth' => ['me@hadathah.org', 'Askar@1984']
        ]);

        $response = $client->post('/mail/users/add', [
            'form_params' => [
                'email' => $user->email,
                'password' => 'user_password', // You might want to generate a password or let the user set it
                'privilege' => 'user'
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            // Handle error
            throw new \Exception('Failed to add user to Mail-in-a-Box');
        }
    }
    public function show($id)
    {
        $user = User::with(['designer', 'saleRep', 'socialRep', 'multiEmployee'])->findOrFail($id);
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'user_image' => $user->user_image, // هذا الحقل يحتوي على الصورة الصحيحة
        ]);
    }
    

}
