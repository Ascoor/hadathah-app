<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MultiEmployeesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('multi_employees')->delete();
        
        \DB::table('multi_employees')->insert(array (
            0 => 
            array (
                'id' => 2,
                'user_id' => 3,
                'name' => 'مها السبيعي',
                'phone' => '01000551144',
                'email' => NULL,
                'image' => '/storage/multi-employees/iwo15LfBmOf3RcSrxaEILmGshXHbzWDCFWsaO4LZ.png',
                'employee_position' => 'المالك',
                'created_at' => '2024-07-20 19:30:20',
                'updated_at' => '2024-07-20 21:24:19',
            ),
            1 => 
            array (
                'id' => 3,
                'user_id' => 7,
                'name' => 'عبدالحميد',
                'phone' => '01002949195',
                'email' => NULL,
                'image' => '/storage/multi-employees/5M7FdIIX7to7U6iMhgaonv29BMF9u4jzaPUYP7Yx.jpg',
                'employee_position' => 'مدير',
                'created_at' => '2024-07-22 06:31:01',
                'updated_at' => '2024-07-22 06:31:01',
            ),
        ));
        
        
    }
}