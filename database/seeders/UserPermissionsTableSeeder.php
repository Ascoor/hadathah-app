<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('user_permissions')->delete();
        
        DB::table('user_permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 16,
                'permission_id' => 1,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 16,
                'permission_id' => 2,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 16,
                'permission_id' => 3,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 16,
                'permission_id' => 4,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 16,
                'permission_id' => 5,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 16,
                'permission_id' => 6,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 16,
                'permission_id' => 7,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 16,
                'permission_id' => 8,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 16,
                'permission_id' => 9,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 16,
                'permission_id' => 10,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 16,
                'permission_id' => 11,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => 16,
                'permission_id' => 12,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'user_id' => 16,
                'permission_id' => 13,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'user_id' => 16,
                'permission_id' => 14,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'user_id' => 16,
                'permission_id' => 15,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'user_id' => 16,
                'permission_id' => 16,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'user_id' => 16,
                'permission_id' => 17,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'user_id' => 16,
                'permission_id' => 18,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'user_id' => 16,
                'permission_id' => 19,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'user_id' => 16,
                'permission_id' => 20,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'user_id' => 16,
                'permission_id' => 21,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'user_id' => 16,
                'permission_id' => 22,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'user_id' => 16,
                'permission_id' => 23,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'user_id' => 16,
                'permission_id' => 24,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'user_id' => 16,
                'permission_id' => 25,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'user_id' => 16,
                'permission_id' => 26,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'user_id' => 16,
                'permission_id' => 27,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'user_id' => 16,
                'permission_id' => 28,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'user_id' => 16,
                'permission_id' => 29,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'user_id' => 16,
                'permission_id' => 30,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'user_id' => 16,
                'permission_id' => 31,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'user_id' => 16,
                'permission_id' => 32,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'user_id' => 16,
                'permission_id' => 33,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'user_id' => 16,
                'permission_id' => 34,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'user_id' => 16,
                'permission_id' => 35,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'user_id' => 16,
                'permission_id' => 36,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'user_id' => 16,
                'permission_id' => 37,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'user_id' => 16,
                'permission_id' => 38,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'user_id' => 16,
                'permission_id' => 39,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'user_id' => 16,
                'permission_id' => 40,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'user_id' => 16,
                'permission_id' => 41,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'user_id' => 16,
                'permission_id' => 42,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'user_id' => 16,
                'permission_id' => 43,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'user_id' => 16,
                'permission_id' => 44,
                'enabled' => 0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}