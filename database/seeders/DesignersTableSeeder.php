<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DesignersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('designers')->delete();
        
        \DB::table('designers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'أحمد حسن',
                'phone' => '01012345678',
                'email' => 'ahmed.hassan@example.com',
                'password_id' => 12,
                'image' => 'https://example.com/images/ahmed.png',
                'skills' => 'تصميم جرافيك, Adobe Photoshop',
                'created_at' => '2024-05-03 00:28:44',
                'updated_at' => '2024-05-03 00:28:44',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'محمد فتحي',
                'phone' => '01023456789',
                'email' => 'mohamed.fathy@example.com',
                'password_id' => 13,
                'image' => 'https://example.com/images/mohamed.png',
                'skills' => 'UI/UX, Figma',
                'created_at' => '2024-05-03 00:28:44',
                'updated_at' => '2024-05-03 00:28:44',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'سارة محمود',
                'phone' => '01034567890',
                'email' => 'sara.mahmoud@example.com',
                'password_id' => 14,
                'image' => NULL,
                'skills' => 'تصميم ويب, HTML, CSS',
                'created_at' => '2024-05-03 00:28:44',
                'updated_at' => '2024-05-03 00:28:44',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'آية علي',
                'phone' => '01045678901',
                'email' => 'aya.ali@example.com',
                'password_id' => 15,
                'image' => NULL,
                'skills' => 'تصميم داخلي, AutoCAD',
                'created_at' => '2024-05-03 00:28:44',
                'updated_at' => '2024-05-03 00:28:44',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'عمر خالد',
                'phone' => '01056789012',
                'email' => 'omar.khaled@example.com',
                'password_id' => 16,
                'image' => NULL,
                'skills' => 'تصميم أزياء, الخياطة',
                'created_at' => '2024-05-03 00:28:44',
                'updated_at' => '2024-05-03 00:28:44',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'نور الدين',
                'phone' => '01067890123',
                'email' => 'nour.eldeen@example.com',
                'password_id' => 17,
                'image' => NULL,
                'skills' => 'تصميم المنتجات, الطباعة ثلاثية الأبعاد',
                'created_at' => '2024-05-03 00:28:45',
                'updated_at' => '2024-05-03 00:28:45',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'ليلى سامي',
                'phone' => '01078901234',
                'email' => 'laila.samy@example.com',
                'password_id' => 18,
                'image' => NULL,
                'skills' => 'تصميم جرافيك, الرسم',
                'created_at' => '2024-05-03 00:28:45',
                'updated_at' => '2024-05-03 00:28:45',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'كريم مصطفى',
                'phone' => '01089012345',
                'email' => 'kareem.mostafa@example.com',
                'password_id' => 19,
                'image' => NULL,
                'skills' => 'الرسوم المتحركة, الرسوم المتحركة ثلاثية الأبعاد',
                'created_at' => '2024-05-03 00:28:45',
                'updated_at' => '2024-05-03 00:28:45',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'فاطمة حسين',
                'phone' => '01090123456',
                'email' => 'fatma.hussien@example.com',
                'password_id' => 20,
                'image' => NULL,
                'skills' => 'التصوير الفوتوغرافي, Adobe Lightroom',
                'created_at' => '2024-05-03 00:28:45',
                'updated_at' => '2024-05-03 00:28:45',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'طارق الشيخ',
                'phone' => '01001234567',
                'email' => 'tarek.el.sheikh@example.com',
                'password_id' => 21,
                'image' => NULL,
                'skills' => 'التصوير السينمائي, Adobe Premiere',
                'created_at' => '2024-05-03 00:28:45',
                'updated_at' => '2024-05-03 00:28:45',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'مريم عبدالله',
                'phone' => '01012345678',
                'email' => 'mariem.ahmed@example.com',
                'password_id' => 22,
                'image' => NULL,
                'skills' => 'التصوير الفوتوغرافي, Adobe Lightroom',
                'created_at' => '2024-05-03 00:28:45',
                'updated_at' => '2024-05-03 00:28:45',
            ),
        ));
        
        
    }
}