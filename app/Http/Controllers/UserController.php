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

    public function getUserImage($userId)
    {
        // جلب المستخدم من الجدول الأساسي
        $user = User::find($userId);
    
        if ($user) {
            // جلب الصورة من جدول المصممين إذا كانت موجودة
            $designer = Designer::where('user_id', $userId)->first();
            if ($designer && $designer->image) {
                return response()->json(['image' => $designer->image]);
            }
    
            // جلب الصورة من جدول ممثلي المبيعات إذا كانت موجودة
            $saleRep = SaleRep::where('user_id', $userId)->first();
            if ($saleRep && $saleRep->image) {
                return response()->json(['image' => $saleRep->image]);
            }
    
            // جلب الصورة من جدول ممثلي الشبكات الاجتماعية إذا كانت موجودة
            $socialRep = SocialRep::where('user_id', $userId)->first();
            if ($socialRep && $socialRep->image) {
                return response()->json(['image' => $socialRep->image]);
            }
    
            // إذا لم يتم العثور على أي صورة في الجداول المختلفة
            return response()->json(['image' => null], 404);
        } else {
            // إذا لم يتم العثور على المستخدم
            return response()->json(null, 404);
        }
    }
    

}
