<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'arabic_name' => 'مدير',
                'created_at' => '2024-07-10 10:57:01',
                'updated_at' => '2024-07-10 10:57:01',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'MultiEmployee',
                'arabic_name' => 'موظف',
                'created_at' => '2024-07-10 10:57:01',
                'updated_at' => '2024-07-10 10:57:01',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'User',
                'arabic_name' => 'مستخدم',
                'created_at' => '2024-07-10 10:57:01',
                'updated_at' => '2024-07-10 10:57:01',
            ),
        ));
        
        
    }
}