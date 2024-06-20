<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 
use App\Models\MultiEmployee;

class MultiEmployeesTableSeeder extends Seeder
{
    public function run()
    {
        $MultiEmployeeData = [
            [
                'name' => 'كامل أبوليلة',
                'email' => 'user1@hadathah.org',
                'phone' => '0567890123',
                'image' => '/storage/multi-employees/XksAkZo9GDANOtFh9QAzDhgW14KaHHpwpvTisYii.png',
                'position' => 'مدير',
                'role_id' => 1
            ],
            [
                'name' => 'مها العتيبي',
                'email' => 'abdulrahman.alghamdi@hadathah.org',
                'phone' => '0567890123',
                'image' => '/storage/multi-employees/XksAkZo9GDANOtFh9QAzDhgW14KaHHpwpvTisYii.png',
                'position' => 'سكرتيرة',
                'role_id' => 3
            ],
            [
                'name' => 'عبدالرحمن الغامدي',
                'phone' => '0567890123',
                'email' => 'abdulrahman.alghamdi@hadathah.org',
                'image' => '/storage/multi-employees/XksAkZo9GDANOtFh9QAzDhgW14KaHHpwpvTisYii.png',
                'position' => 'موظف',
                'role_id' => 2
            ],
            [
                'name' => 'هيثم الشمري',
                'phone' => '05452789012',
                'email' => 'hitham.alshammari@hadathah.org',
                'image' => '/storage/multi-employees/jmPRUS8mcHghhXeE5T3taYQQcbpd6YdswfpbNHqz.png',
                'position' => 'موظف',
                'role_id' => 2
            ],
            [
                'name' => 'مريم الفيصل',
                'phone' => '0522678901',
                'email' => 'maria.alfaisal@hadathah.org',
                'image' => '/storage/multi-employees/jmPRUS8mcHghhXeE5T3taYQQcbpd6YdswfpbNHqz.png',
                'position' => 'موظف',
                'role_id' => 2
            ],
            [
                'name' => 'هلا السليمان',
                'phone' => '0534567890',
                'email' => 'hala.alsulaiman@hadathah.org',
                'image' => '/storage/multi-employees/jmPRUS8mcHghhXeE5T3taYQQcbpd6YdswfpbNHqz.png',
                'position' => 'موظف',
                'role_id' => 2
            ],
            [
                'name' => 'محمد الميوف',
                'phone' => '0523456789',
                'email' => 'user5@hadathah.org',
                'image' => '/storage/multi-employees/qmvOkek0yXYvS1D2PpO3BNGgwuktOscOvYcUp5Zj.png',
                'position' => 'موظف',
                'role_id' => 2
            ]
        ];

        foreach ($MultiEmployeeData as $index => $data) {
            // Ensure a user account for each multi-employee or create one
            $role_id = $index === 0 ? 1 : $data['role_id'];
            
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make('Askar@1984'), // Consider setting a more secure, dynamically generated password
                    'role_id' => $role_id,
                ]
            );

            // Create or update the multi-employee profile linked to the user
            MultiEmployee::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'image' => $data['image'],
                    'position' => $data['position'],
                ]
            );
        }
    }
}
