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
            'email' => 'kamel.abolela@hadathah.org',
            'phone' => '0567890123',
            'image' => '/storage/multi-employees/si1dD0tVeBQOta6M4VQMDkvfEcfItsXXJvAvcQfx.png',
            'employee_position' => 'مدير عام',
            'role_id' => 1 
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
                'password' => Hash::make('Kamel@1984'), // Consider setting a more secure, dynamically generated password
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
                'employee_position' => $data['employee_position'],
            ]
        );
    }
}
}