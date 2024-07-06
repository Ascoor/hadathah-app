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
                'id' => 45,
                'user_id' => 1,
                'permission_id' => 1,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 46,
                'user_id' => 1,
                'permission_id' => 2,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 47,
                'user_id' => 1,
                'permission_id' => 3,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 48,
                'user_id' => 1,
                'permission_id' => 4,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 49,
                'user_id' => 1,
                'permission_id' => 5,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 50,
                'user_id' => 1,
                'permission_id' => 6,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 51,
                'user_id' => 1,
                'permission_id' => 7,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 52,
                'user_id' => 1,
                'permission_id' => 8,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 53,
                'user_id' => 1,
                'permission_id' => 9,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 54,
                'user_id' => 1,
                'permission_id' => 10,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 55,
                'user_id' => 1,
                'permission_id' => 11,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 56,
                'user_id' => 1,
                'permission_id' => 12,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 57,
                'user_id' => 1,
                'permission_id' => 13,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 58,
                'user_id' => 1,
                'permission_id' => 14,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 59,
                'user_id' => 1,
                'permission_id' => 15,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 60,
                'user_id' => 1,
                'permission_id' => 16,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 61,
                'user_id' => 1,
                'permission_id' => 17,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 62,
                'user_id' => 1,
                'permission_id' => 18,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 63,
                'user_id' => 1,
                'permission_id' => 19,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 64,
                'user_id' => 1,
                'permission_id' => 20,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 65,
                'user_id' => 1,
                'permission_id' => 21,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 66,
                'user_id' => 1,
                'permission_id' => 22,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 67,
                'user_id' => 1,
                'permission_id' => 23,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 68,
                'user_id' => 1,
                'permission_id' => 24,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 69,
                'user_id' => 1,
                'permission_id' => 25,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 70,
                'user_id' => 1,
                'permission_id' => 26,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 71,
                'user_id' => 1,
                'permission_id' => 27,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 72,
                'user_id' => 1,
                'permission_id' => 28,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 73,
                'user_id' => 1,
                'permission_id' => 29,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 74,
                'user_id' => 1,
                'permission_id' => 30,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 75,
                'user_id' => 1,
                'permission_id' => 31,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 76,
                'user_id' => 1,
                'permission_id' => 32,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 77,
                'user_id' => 1,
                'permission_id' => 33,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 78,
                'user_id' => 1,
                'permission_id' => 34,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 79,
                'user_id' => 1,
                'permission_id' => 35,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 80,
                'user_id' => 1,
                'permission_id' => 36,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 81,
                'user_id' => 1,
                'permission_id' => 37,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 82,
                'user_id' => 1,
                'permission_id' => 38,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 83,
                'user_id' => 1,
                'permission_id' => 39,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 84,
                'user_id' => 1,
                'permission_id' => 40,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 85,
                'user_id' => 1,
                'permission_id' => 41,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 86,
                'user_id' => 1,
                'permission_id' => 42,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 87,
                'user_id' => 1,
                'permission_id' => 43,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 88,
                'user_id' => 1,
                'permission_id' => 44,
                'enabled' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}