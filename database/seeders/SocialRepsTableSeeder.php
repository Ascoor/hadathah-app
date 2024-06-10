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
        $socialRepsData = [
            [
                'name' => 'مها العتيبي',
                'phone' => '0581234567',
                'email' => 'maha@hadathah.org',
                'image' => '/storage/sale-rep/9Rn387Cas1nTvp8DQdQz56InbT1HCIfittvQLWYD.png',
                'skills' => 'إدارة وسائل التواصل الاجتماعي, إنشاء المحتوى',
            ],
            [
                'name' => 'أحمد الناصر',
                'phone' => '0572345678',
                'email' => 'ahmed@hadathah.org',
                'image' => '/storage/social-reps/ahmed_image.png',
                'skills' => 'التسويق الرقمي, تحسين محركات البحث (SEO)',
            ],
            [
                'name' => 'نورا الفيصل',
                'phone' => '0522678901',
                'email' => 'nora@hadathah.org',
                'image' => '/storage/social-reps/nora_image.png',
                'skills' => 'تصميم جرافيك, Adobe Photoshop',
            ],
            [
                'name' => 'لمى السليمان',
                'phone' => '0534567890',
                'email' => 'lama@hadathah.org',
                'image' => '/storage/social-reps/lama_image.png',
                'skills' => 'إنتاج الفيديو, التحرير',
            ],
            [
                'name' => 'خالد الميوف',
                'phone' => '0523456789',
                'email' => 'user4@hadathah.org',
                'image' => '/storage/social-reps/khalid_image.png',
                'skills' => 'التواصل مع المؤثرين, شراكات العلامة التجارية',
            ]
        ];

        foreach ($socialRepsData as $data) {
            // Ensure a user account for each social representative or create one
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make('Askar@1984'), // Consider setting a more secure, dynamically generated password
                    'role_id' => 4,
                    ]
            );

    
            // Create or update the social representative profile linked to the user
            SocialRep::updateOrCreate(
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