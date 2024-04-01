<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'كامل أبوليلة',
            'email' => 'test@test.com',
            'password' => Hash::make('Ask@123456'),
        ]);
    }
}
