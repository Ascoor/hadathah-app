<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('designers')->delete();
        
        DB::table('designers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'أحمد حسن',
                'phone' => '01015345678',
                'email' => 'ahmed.hassan@example.com',
                'password_id' => 12,
                'image' => '/storage/designers/qmvOkek0yXYvS1D2PpO3BNGgwuktOscOvYcUp5Zj.png',
                'skills' => 'تصميم جرافيك, Adobe Photoshop',
                'created_at' => '2024-05-03 00:28:44',
                'updated_at' => '2024-05-03 00:40:34',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'محمد فتحي',
                'phone' => '01023456439',
                'email' => 'mohamed.fathy@example.com',
                'password_id' => 13,
                'image' => '/storage/designers/uZI8OmnwuIgM4lsuJXz56PZPV2ldYtGVwQNKEF3A.png',
                'skills' => 'UI/UX, Figma',
                'created_at' => '2024-05-03 00:28:44',
                'updated_at' => '2024-05-03 00:40:49',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'سارة محمود',
                'phone' => '01034563890',
                'email' => 'sara.mahmoud@example.com',
                'password_id' => 14,
                'image' => '/storage/designers/jmPRUS8mcHghhXeE5T3taYQQcbpd6YdswfpbNHqz.png',
                'skills' => 'تصميم ويب, HTML, CSS',
                'created_at' => '2024-05-03 00:28:44',
                'updated_at' => '2024-05-03 00:40:59',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'آية علي',
                'phone' => '01045328901',
                'email' => 'aya.ali@example.com',
                'password_id' => 15,
                'image' => '/storage/designers/W6FmT6tsD5BeTJEE5wsyPL4Rk5i2O9QV2dF0C9Fo.png',
                'skills' => 'تصميم داخلي, AutoCAD',
                'created_at' => '2024-05-03 00:28:44',
                'updated_at' => '2024-05-03 00:41:12',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'عمر خالد',
                'phone' => '01056739012',
                'email' => 'omar.khaled@example.com',
                'password_id' => 16,
                'image' => '/storage/designers/xLWJKdVf9Ln6liNLLuvo5tR4LLe6YAQl4SYx4wK7.png',
                'skills' => 'تصميم أزياء, الخياطة',
                'created_at' => '2024-05-03 00:28:44',
                'updated_at' => '2024-05-03 00:41:23',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'نور الدين',
                'phone' => '2323890123',
                'email' => 'nour.eldeen@example.com',
                'password_id' => 17,
                'image' => '/storage/designers/MyppAbAMFMH4fVpyUVyd84CzMqqKnb76jFHcrvwy.png',
                'skills' => 'تصميم المنتجات, الطباعة ثلاثية الأبعاد',
                'created_at' => '2024-05-03 00:28:45',
                'updated_at' => '2024-05-03 00:41:45',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'ليلى سامي',
                'phone' => '01072231234',
                'email' => 'laila.samy@example.com',
                'password_id' => 18,
                'image' => '/storage/designers/GvJdWmMfE50xOAegYtMEf0olQdbLhnBz5iwQ1dyI.png',
                'skills' => 'تصميم جرافيك, الرسم',
                'created_at' => '2024-05-03 00:28:45',
                'updated_at' => '2024-05-03 00:41:57',
            ),
        ));
        
        
    }
}