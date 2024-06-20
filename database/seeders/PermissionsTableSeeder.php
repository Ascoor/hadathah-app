<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $permissions = [
            ['name' => 'show', 'section' => 'Users'],
            ['name' => 'add', 'section' => 'Users'],
            ['name' => 'update', 'section' => 'Users'],
            ['name' => 'delete', 'section' => 'Users'],

            ['name' => 'show', 'section' => 'MultiEmployees'],
            ['name' => 'add', 'section' => 'MultiEmployees'],
            ['name' => 'update', 'section' => 'MultiEmployees'],
            ['name' => 'delete', 'section' => 'MultiEmployees'],
            ['name' => 'show', 'section' => 'Orders'],
            ['name' => 'add', 'section' => 'Orders'],
            ['name' => 'update', 'section' => 'Orders'],
            ['name' => 'delete', 'section' => 'Orders'],
            ['name' => 'show', 'section' => 'Customers'],
            ['name' => 'add', 'section' => 'Customers'],
            ['name' => 'update', 'section' => 'Customers'],
            ['name' => 'delete', 'section' => 'Customers'],
            ['name' => 'show', 'section' => 'Designs'],
            ['name' => 'add', 'section' => 'Designs'],
            ['name' => 'update', 'section' => 'Designs'],
            ['name' => 'delete', 'section' => 'Designs'],
            ['name' => 'show', 'section' => 'Designers'],
            ['name' => 'add', 'section' => 'Designers'],
            ['name' => 'update', 'section' => 'Designers'],
            ['name' => 'delete', 'section' => 'Designers'],
            ['name' => 'show', 'section' => 'SocialReps'],
            ['name' => 'add', 'section' => 'SocialReps'],
            ['name' => 'update', 'section' => 'SocialReps'],
            ['name' => 'delete', 'section' => 'SocialReps'],
            ['name' => 'show', 'section' => 'SaleReps'],
            ['name' => 'add', 'section' => 'SaleReps'],
            ['name' => 'update', 'section' => 'SaleReps'],
            ['name' => 'delete', 'section' => 'SaleReps'],
            ['name' => 'show', 'section' => 'Offers'],
            ['name' => 'add', 'section' => 'Offers'],
            ['name' => 'update', 'section' => 'Offers'],
            ['name' => 'delete', 'section' => 'Offers'],
            ['name' => 'show', 'section' => 'Products'],
            ['name' => 'add', 'section' => 'Products'],
            ['name' => 'update', 'section' => 'Products'],
            ['name' => 'delete', 'section' => 'Products'],
            ['name' => 'show', 'section' => 'Categories'],
            ['name' => 'add', 'section' => 'Categories'],
            ['name' => 'update', 'section' => 'Categories'],
            ['name' => 'delete', 'section' => 'Categories'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'name' => $permission['name'],
                'section' => $permission['section'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}