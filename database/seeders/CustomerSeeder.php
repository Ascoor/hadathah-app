<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
        {
            $faker = Faker::create('ar_SA');
    
            for ($i = 0; $i < 500; $i++) {
                DB::table('customers')->insert([
                    'name' => $faker->name,
                    'address' => $faker->address,
                    'phone' => $this->generateValidPhoneNumber($faker),
                    'gender' => $faker->randomElement(['ذكر', 'أنثى']),
                    'email' => $faker->unique()->safeEmail,
                    'city' => $faker->city,
                    'country' => 'السعودية',
                    'notes' => $faker->realText(),
                ]);
            }
        }
    
        private function generateValidPhoneNumber($faker)
        {
            // Generate a phone number that starts with '0' followed by 10 digits
            $phoneNumber = '0' . $faker->numerify('##########');
            return $phoneNumber;
        }
    }
    