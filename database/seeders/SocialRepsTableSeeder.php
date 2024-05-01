<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Password; // Import the Password model

class SocialRepsTableSeeder extends Seeder
{
    public function run()
    {
        $socialReps = [
            ['مها العتيبي', '0581234567', null, 'إدارة وسائل التواصل الاجتماعي, إنشاء المحتوى'],
            ['أحمد الناصر', '0572345678', null, 'التسويق الرقمي, تحسين محركات البحث (SEO)'],
            ['ريما الخليفة', '0563456789', null, 'تصميم جرافيك, Adobe Photoshop'],
            ['فيصل السعود', '0554567890', null, 'إنتاج الفيديو, التحرير'],
            ['ليان الباكر', '0545678901', null, 'التواصل مع المؤثرين, شراكات العلامة التجارية'],
            ['عمر الفضل', '0536789012', null, 'كتابة الإعلانات, التدوين'],
            ['هالة الخاشقجي', '0527890123', null, 'تخطيط الفعاليات, العلاقات العامة'],
            ['خليل الفهيم', '0518901234', null, 'تطوير الويب, JavaScript'],
            ['سارة الشريف', '0599012345', null, 'تصميم واجهة المستخدم/تجربة المستخدم, Figma'],
            ['نواف التميمي', '0580123456', null, 'التصوير الفوتوغرافي, Adobe Lightroom'],
                 // Add other social reps here
        ];

        foreach ($socialReps as $rep) {
            // Check if the password already exists in the passwords table
            $password = 'your_password_here'; // Set the default password for social reps
            $passwordModel = Password::where('password', Hash::make($password))->first();

            // If the password doesn't exist, create a new record in the passwords table
            if (!$passwordModel) {
                $passwordModel = Password::create([
                    'password' => Hash::make($password),
                ]);
            }

            // Insert the social rep record with the password ID
            DB::table('social_reps')->insert([
                'name' => $rep[0],
                'phone' => $rep[1],
                'image' => $rep[2],
                'skills' => $rep[3],
                'password_id' => $passwordModel->id, // Use the password ID
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
