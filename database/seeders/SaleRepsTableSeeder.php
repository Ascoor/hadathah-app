<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use App\Models\User; 
use App\Models\SaleRep;
class SaleRepsTableSeeder extends Seeder
{
    public function run()
    {
        $saleRepsData = [
            [
                'name' => 'فهد الغامدي',
                'phone' => '0567890123',
                'email' => 'fahad.alghamdi@hadathah.org',
                'image' => '/storage/sale-rep/XksAkZo9GDANOtFh9QAzDhgW14KaHHpwpvTisYii.png',
                'covered_areas' => 'الرياض, جدة',
            ],
            [
                'name' => 'سعود الشمري',
                'phone' => '05452789012',
                'email' => 'saud.alshammari@hadathah.org',
                'image' => '/storage/designers/jmPRUS8mcHghhXeE5T3taYQQcbpd6YdswfpbNHqz.png',
                'covered_areas' => 'الدمام, الخبر',
            ],
            [
                'name' => 'نورا الفيصل',
                'phone' => '0522678901',
                'email' => 'nora.alfaisal@hadathah.org',
                'image' => '/storage/designers/jmPRUS8mcHghhXeE5T3taYQQcbpd6YdswfpbNHqz.png',
                'covered_areas' => 'مكة, المدينة',
            ],
            [
                'name' => 'لمى السليمان',
                'phone' => '0534567890',
                'email' => 'lama.alsulaiman@hadathah.org',
              
                'image' => '/storage/designers/jmPRUS8mcHghhXeE5T3taYQQcbpd6YdswfpbNHqz.png',
                'covered_areas' => 'الطائف, جدة',
            ],
            [
                'name' => 'خالد الميوف',
                'phone' => '0523456789',
                'email' => 'user3@hadathah.org',
                'image' => '/storage/designers/qmvOkek0yXYvS1D2PpO3BNGgwuktOscOvYcUp5Zj.png',
                'covered_areas' => 'الرياض, الأحساء',
            ]
        ];

        foreach ($saleRepsData as $data) {
            // Ensure a user account for each sales representative or create one
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make('Askar@1984'), // Consider setting a more secure, dynamically generated password
                    'role_id' => 2,
                    ]
            );

            // Create or update the sales representative profile linked to the user
            SaleRep::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'image' => $data['image'],
                    'covered_areas' => $data['covered_areas'],
                ]
            );
        }
    }
}