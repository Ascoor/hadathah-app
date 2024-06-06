<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use App\Models\User;  // Ensure this is the correct path to your User model
use App\Models\Designer;  // Assuming Designer model is also in App\Models

class DesignersTableSeeder extends Seeder
{
    public function run()
    {
        $designersData = [
            [
                'name' => 'أحمد حسن',
                'phone' => '01015345678',
                'email' => 'ahmed.hassan@hadathah.org',
                'image' => '/storage/designers/qmvOkek0yXYvS1D2PpO3BNGgwuktOscOvYcUp5Zj.png',
                'skills' => 'تصميم جرافيك, Adobe Photoshop',
            ],
            [
                'name' => 'محمد فتحي',
                'phone' => '01023456439',
                'email' => 'mohamed.fathy@hadathah.org',
                'image' => '/storage/designers/uZI8OmnwuIgM4lsuJXz56PZPV2ldYtGVwQNKEF3A.png',
                'skills' => 'UI/UX, Figma',
            ],
            [
                'name' => 'سارة محمود',
                'phone' => '01034563890',
                'email' => 'sara.mahmoud@hadathah.org',
                'image' => '/storage/designers/sara_image.png',
                'skills' => 'تصميم ويب, HTML, CSS',
            ],
            [
                'name' => 'آية علي',
                'phone' => '01045328901',
                'email' => 'aya.ali@hadathah.org',
                'image' => '/storage/designers/aya_image.png',
                'skills' => 'تصميم داخلي, AutoCAD',
            ],
            [
                'name' => 'عمر خالد',
                'phone' => '01056739012',
                'email' => 'omar.khaled@hadathah.org',
                'image' => '/storage/designers/omar_image.png',
                'skills' => 'تصميم أزياء, الخياطة',
            ]
        ];

        foreach ($designersData as $data) {
            // Ensure a user account for each designer or create one
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make('defaultPassword123'), 
                    'role_id' => 2,
                    ]
            );

            // Create or update the designer profile linked to the user
            Designer::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'image' => $data['image'],
                    'skills' => $data['skills'],
                ]
            );
        }
    }
}