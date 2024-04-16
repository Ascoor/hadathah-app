<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [
            [
                'name' => 'فهد العتيبي',
                'address' => 'شارع الملك فهد، الرياض',
                'contact_number' => '0555000111',
                'gender' => 'ذكر',
                'email' => 'fahad.otb@example.com',
                'city' => 'الرياض',
                'country' => 'السعودية',
                'notes' => '',
            ],
            [
                'name' => 'سارة الفهد',
                'address' => 'حي الخبر، الخبر',
                'contact_number' => '0555000222',
                'gender' => 'أنثى',
                'email' => 'sarah.alfahd@example.com',
                'city' => 'الخبر',
                'country' => 'السعودية',
                'notes' => '',
            ],
            [
                'name' => 'أحمد الشهري',
                'address' => 'حي النسيم، جدة',
                'contact_number' => '0555000333',
                'gender' => 'ذكر',
                'email' => 'ahmed.alshahri@example.com',
                'city' => 'جدة',
                'country' => 'السعودية',
                'notes' => '',
            ],
            // أضف العملاء الآخرين بنفس الطريقة ولكن باستخدام بيانات مختلفة

            [
                'name' => 'عبدالرحمن الشعران',
                'address' => 'شارع السلام، الرياض',
                'contact_number' => '0555000444',
                'gender' => 'ذكر',
                'email' => 'abdelrahman.alshearan@example.com',
                'city' => 'الرياض',
                'country' => 'السعودية',
                'notes' => '',  

            ],
            ['name' => 'سارة سعيد', 
            'email' => 'sarah.saeid@example.com',
            'address' => 'شارع السلام، الرياض',
            'contact_number' => '0555000555',
            'gender' => 'أنثى',
            'city' => 'الرياض',
            'country' => 'السعودية',
            'notes' => '',
        ],
        // أضف العملاء الآخرين بنفس الطريقة ولكن باستخدام بيانات مختلفة

        [
            'name' => 'صالح الشيخ',
            'address' => 'شارع السلام، الرياض',
            'contact_number' => '0555000666',
            'gender' => 'ذكر',
            'email' => 'saleh.alsheikh@example.com',
            'city' => 'الرياض',
            'country' => 'السعودية',
            'notes' => '',
            ]
        ];


        foreach ($customers as $customer) {
            DB::table('customers')->insert($customer);
        }
    }
}