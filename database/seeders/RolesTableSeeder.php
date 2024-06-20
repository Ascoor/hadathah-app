<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'Admin' => 'مدير',
            'MultiEmployee' => 'موظف',
            'User' => 'مستخدم'
        ];

        foreach ($roles as $key => $value) {
            // Ensure that duplicate roles are not created
            Role::firstOrCreate([
                'name' => $key
            ], [
                'name' => $key,
                'arabic_name' => $value  // Assuming you have an 'arabic_name' column for Arabic role names
            ]);
        }
    }
}
