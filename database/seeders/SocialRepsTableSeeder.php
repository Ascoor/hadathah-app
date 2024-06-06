<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use App\Models\User; 

use App\Models\SocialRep;

class SocialRepsTableSeeder extends Seeder
{
    public function run()
    {
        // Assuming users have already been created or you create them as needed
        $users = User::whereIn('email', [
            'maha@hadathah.org', // Correct this according to actual emails in your database
            'ahmed@hadathah.org', // Correct this according to actual emails in your database
            // Add other emails as needed
        ])->get()->keyBy('email');

        $socialRepsData = [
            [
                'name' => 'مها العتيبي',
                'phone' => '0581234567',
                'email' => 'maha@hadathah.org', // Ensure the email is included
                'image' => '/storage/social-reps/FNKYVfPtuLHRmLpfYEQDGL01ZJTkPk0W8t4qUJvL.png',
                'skills' => 'إدارة وسائل التواصل الاجتماعي, إنشاء المحتوى',
            ],
            [
                'name' => 'أحمد الناصر',
                'phone' => '0572345678',
                'email' => 'ahmed@hadathah.org', // Ensure the email is included
                'image' => '/storage/social-reps/f3OaCevlgerJ6ZitmGT3e6o7IawM4leIREHUITeA.png',
                'skills' => 'التسويق الرقمي, تحسين محركات البحث (SEO)',
            ],
            // Add other representatives as needed
        ];

        foreach ($socialRepsData as $repData) {
            $user = $users[$repData['email']] ?? null;
            if ($user) {
                SocialRep::create([
                    'user_id' => $user->id,
                    'name' => $repData['name'],
                    'phone' => $repData['phone'],
                    'image' => $repData['image'],
                    'skills' => $repData['skills'],
                ]);
            }
        }
    }
}