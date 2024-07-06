<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            [
                'name' => 'كامل أبوليلة',
                'email' => 'kamel.abolela@hadathah.org',
                'password' => Hash::make('Kamel@1986'),
                'role_id' => 1
            ],
            // [
            //     'name' => 'مها العتيبي',
            //     'email' => 'user5@hadathah.org',
            //     'password' => Hash::make('Askar@1984'),
            //     'role_id' => 3
            // ]
        ]);
    }
}
