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
                'image' => '/storage/multi-employees/si1dD0tVeBQOta6M4VQMDkvfEcfItsXXJvAvcQfx.png',
                'position' => 'مدير',
                'role_id' => 1
            ],
            [
                'name' => 'مها العتيبي',
                'email' => 'abdulrahman.alghamdi@hadathah.org',
                'phone' => '0567890123',
                'image' => '//storage/multi-employees/uZI8OmnwuIgM4lsuJXz56PZPV2ldYtGVwQNKEF3A.png',
                'position' => 'سكرتيرة',
                'role_id' => 3
            ],
            [
                'name' => 'عبدالرحمن الغامدي',
                'phone' => '0567890123',
                'email' => 'abdulrahman.alghamdi@hadathah.org',
                'image' => '/storage/multi-employees/W6FmT6tsD5BeTJEE5wsyP4Rk5i2O9QV2dF0C9Fo.png',
                'position' => 'موظف',
                'role_id' => 2
            ],
            [
                'name' => 'هيثم الشمري',
                'phone' => '05452789012',
                'email' => 'hitham.alshammari@hadathah.org',
                'image' => '/storage/multi-employees/xigO9RsyNyIDrsmL4aBHYVvWXJSGrBOtIaduX5Lj.png',
                'position' => 'موظف',
                'role_id' => 2
            ],
            [
                'name' => 'مريم الفيصل',
                'phone' => '0522678901',
                'email' => 'maria.alfaisal@hadathah.org',
                'image' => '/storage/multi-employees/xLWJKdVf9Ln6liNLLuvo5tR4LLe6YAQl4SYx4wK7.png',
                'position' => 'موظف',
                'role_id' => 2
            ],
            [
                'name' => 'هلا السليمان',
                'phone' => '0534567890',
                'email' => 'hala.alsulaiman@hadathah.org',
                'image' => '/storage/multi-employees/XSYpEhLMFVYrMvZVyRaWLESV80HGSowF6A0ozyDb.png',
                'position' => 'موظف',
                'role_id' => 2
            ],
            [
                'name' => 'محمد الميوف',
                'phone' => '0523456789',
                'email' => 'user5@hadathah.org',
                'image' => '/storage/multi-employees/y5YK4esQkrpfAxTWIsA9VeGYzydSEqjwgwIy6YnH.png',
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
