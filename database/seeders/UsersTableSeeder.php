<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 3,
                'name' => 'مها السبيعي',
                'email' => 'maha-alsubaie@hadathah.org',
                'email_verified_at' => NULL,
                'activation_code' => NULL,
                'reset_token_expires_at' => NULL,
                'role_id' => 1,
                'password' => '$2y$10$60bsZnKyowZ9bsdsTvHLTu55x/zHuoCghnAUG76RHIKF9CWjaxwx6',
                'is_active' => 0,
                'reset_token' => NULL,
                'remember_token' => NULL,
                'created_at' => '2024-07-20 19:30:20',
                'updated_at' => '2024-07-25 21:32:57',
            ),
            1 => 
            array (
                'id' => 6,
                'name' => 'شريفة الأسمري',
                'email' => 'shryft.alasmry-saleRep@hadathah.org',
                'email_verified_at' => NULL,
                'activation_code' => NULL,
                'reset_token_expires_at' => NULL,
                'role_id' => 2,
                'password' => '$2y$10$ehleIE5Z8kkn/SmoqEq5L.83yh9OLMm9ojQ4YUts1bdW0EkARGJ..',
                'is_active' => 0,
                'reset_token' => NULL,
                'remember_token' => NULL,
                'created_at' => '2024-07-20 20:28:36',
                'updated_at' => '2024-07-20 20:28:36',
            ),
            2 => 
            array (
                'id' => 7,
                'name' => 'عبدالحميد',
                'email' => 'askar@hadathah.org',
                'email_verified_at' => NULL,
                'activation_code' => NULL,
                'reset_token_expires_at' => NULL,
                'role_id' => 1,
                'password' => '$2y$10$XAMRFKHuO78cowxTH2DaXevLJutDHkbPQahsXrRmPI9UR.lI3Ubv.',
                'is_active' => 0,
                'reset_token' => NULL,
                'remember_token' => NULL,
                'created_at' => '2024-07-22 06:31:01',
                'updated_at' => '2024-07-31 17:02:57',
            ),
        ));
        
        
    }
}