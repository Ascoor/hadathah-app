<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialRepsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('social_reps')->delete();
        
        DB::table('social_reps')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'مها العتيبي',
                'phone' => '0581234567',
                'email' => NULL,
                'password_id' => 33,
                'image' => '/storage/social-reps/FNKYVfPtuLHRmLpfYEQDGL01ZJTkPk0W8t4qUJvL.png',
                'skills' => 'إدارة وسائل التواصل الاجتماعي, إنشاء المحتوى',
                'created_at' => '2024-05-03 00:28:47',
                'updated_at' => '2024-05-03 00:55:06',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'أحمد الناصر',
                'phone' => '0572345678',
                'email' => NULL,
                'password_id' => 34,
                'image' => '/storage/social-reps/f3OaCevlgerJ6ZitmGT3e6o7IawM4leIREHUITeA.png',
            'skills' => 'التسويق الرقمي, تحسين محركات البحث (SEO)',
                'created_at' => '2024-05-03 00:28:48',
                'updated_at' => '2024-05-03 00:58:09',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'ريما الخليفة',
                'phone' => '0563456789',
                'email' => NULL,
                'password_id' => 35,
                'image' => '/storage/social-reps/4duO5spngAB4SQzAY7HgGIlBXvqU6fODMVwRU35f.png',
                'skills' => 'تصميم جرافيك, Adobe Photoshop',
                'created_at' => '2024-05-03 00:28:48',
                'updated_at' => '2024-05-03 00:58:20',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'فيصل السعود',
                'phone' => '0554567890',
                'email' => NULL,
                'password_id' => 36,
                'image' => NULL,
                'skills' => 'إنتاج الفيديو, التحرير',
                'created_at' => '2024-05-03 00:28:48',
                'updated_at' => '2024-05-03 00:28:48',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'ليان الباكر',
                'phone' => '0545678901',
                'email' => NULL,
                'password_id' => 37,
                'image' => NULL,
                'skills' => 'التواصل مع المؤثرين, شراكات العلامة التجارية',
                'created_at' => '2024-05-03 00:28:48',
                'updated_at' => '2024-05-03 00:28:48',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'عمر الفضل',
                'phone' => '0536789012',
                'email' => NULL,
                'password_id' => 38,
                'image' => NULL,
                'skills' => 'كتابة الإعلانات, التدوين',
                'created_at' => '2024-05-03 00:28:48',
                'updated_at' => '2024-05-03 00:28:48',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'هالة الخاشقجي',
                'phone' => '0527890123',
                'email' => NULL,
                'password_id' => 39,
                'image' => NULL,
                'skills' => 'تخطيط الفعاليات, العلاقات العامة',
                'created_at' => '2024-05-03 00:28:48',
                'updated_at' => '2024-05-03 00:28:48',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'خليل الفهيم',
                'phone' => '0518901234',
                'email' => NULL,
                'password_id' => 40,
                'image' => NULL,
                'skills' => 'تطوير الويب, JavaScript',
                'created_at' => '2024-05-03 00:28:49',
                'updated_at' => '2024-05-03 00:28:49',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'سارة الشريف',
                'phone' => '0599012345',
                'email' => NULL,
                'password_id' => 41,
                'image' => NULL,
                'skills' => 'تصميم واجهة المستخدم/تجربة المستخدم, Figma',
                'created_at' => '2024-05-03 00:28:49',
                'updated_at' => '2024-05-03 00:28:49',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'نواف التميمي',
                'phone' => '0580123456',
                'email' => NULL,
                'password_id' => 42,
                'image' => NULL,
                'skills' => 'التصوير الفوتوغرافي, Adobe Lightroom',
                'created_at' => '2024-05-03 00:28:49',
                'updated_at' => '2024-05-03 00:28:49',
            ),
        ));
        
        
    }
}