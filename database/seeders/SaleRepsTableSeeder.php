<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SaleRepsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sale_reps')->delete();
        
        \DB::table('sale_reps')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'فهد الغامدي',
                'phone' => '0567890123',
                'email' => 'fahad.alghamdi@example.com',
                'password_id' => 23,
                'image' => NULL,
                'covered_areas' => 'الرياض, جدة',
                'created_at' => '2024-05-03 00:28:46',
                'updated_at' => '2024-05-03 00:28:46',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'سعود الشمري',
                'phone' => '0556789012',
                'email' => 'saud.alshammari@example.com',
                'password_id' => 24,
                'image' => NULL,
                'covered_areas' => 'الدمام, الخبر',
                'created_at' => '2024-05-03 00:28:46',
                'updated_at' => '2024-05-03 00:28:46',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'نورا الفيصل',
                'phone' => '0545678901',
                'email' => 'nora.alfaisal@example.com',
                'password_id' => 25,
                'image' => NULL,
                'covered_areas' => 'مكة, المدينة',
                'created_at' => '2024-05-03 00:28:46',
                'updated_at' => '2024-05-03 00:28:46',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'لمى السليمان',
                'phone' => '0534567890',
                'email' => 'lama.alsulaiman@example.com',
                'password_id' => 26,
                'image' => NULL,
                'covered_areas' => 'الطائف, جدة',
                'created_at' => '2024-05-03 00:28:46',
                'updated_at' => '2024-05-03 00:28:46',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'خالد الميوف',
                'phone' => '0523456789',
                'email' => 'khalid.almayouf@example.com',
                'password_id' => 27,
                'image' => NULL,
                'covered_areas' => 'الرياض, الأحساء',
                'created_at' => '2024-05-03 00:28:46',
                'updated_at' => '2024-05-03 00:28:46',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'حسين الجهني',
                'phone' => '0512345678',
                'email' => 'hussain.aljuhani@example.com',
                'password_id' => 28,
                'image' => NULL,
                'covered_areas' => 'الجبيل, ينبع',
                'created_at' => '2024-05-03 00:28:46',
                'updated_at' => '2024-05-03 00:28:46',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'أمل القحطاني',
                'phone' => '0598765432',
                'email' => 'amal.alqahtani@example.com',
                'password_id' => 29,
                'image' => NULL,
                'covered_areas' => 'نجران, جيزان',
                'created_at' => '2024-05-03 00:28:47',
                'updated_at' => '2024-05-03 00:28:47',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'يوسف النمير',
                'phone' => '0587654321',
                'email' => 'yousef.alnamir@example.com',
                'password_id' => 30,
                'image' => NULL,
                'covered_areas' => 'تبوك, العلا',
                'created_at' => '2024-05-03 00:28:47',
                'updated_at' => '2024-05-03 00:28:47',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'عبير المبارك',
                'phone' => '0576543210',
                'email' => 'abeer.almubarak@example.com',
                'password_id' => 31,
                'image' => NULL,
                'covered_areas' => 'القصيم, حائل',
                'created_at' => '2024-05-03 00:28:47',
                'updated_at' => '2024-05-03 00:28:47',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'طارق الحربي',
                'phone' => '0565432109',
                'email' => 'tariq.alharbi@example.com',
                'password_id' => 32,
                'image' => NULL,
                'covered_areas' => 'المنطقة الشرقية, الرياض',
                'created_at' => '2024-05-03 00:28:47',
                'updated_at' => '2024-05-03 00:28:47',
            ),
        ));
        
        
    }
}