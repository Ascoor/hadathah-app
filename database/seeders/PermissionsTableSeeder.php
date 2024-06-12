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
            ['name' => 'add', 'section' => 'Orders'],
            ['name' => 'update', 'section' => 'Orders'],
            ['name' => 'delete', 'section' => 'Orders'],
            ['name' => 'add', 'section' => 'Customers'],
            ['name' => 'update', 'section' => 'Customers'],
            ['name' => 'delete', 'section' => 'Customers'],
            ['name' => 'add', 'section' => 'Designs'],
            ['name' => 'update', 'section' => 'Designs'],
            ['name' => 'delete', 'section' => 'Designs'],
            ['name' => 'add', 'section' => 'Marketing'],
            ['name' => 'update', 'section' => 'Marketing'],
            ['name' => 'delete', 'section' => 'Marketing'],
            ['name' => 'add', 'section' => 'Sales'],
            ['name' => 'update', 'section' => 'Sales'],
            ['name' => 'delete', 'section' => 'Sales'],
            ['name' => 'add', 'section' => 'Offers'],
            ['name' => 'update', 'section' => 'Offers'],
            ['name' => 'delete', 'section' => 'Offers'],
            ['name' => 'add', 'section' => 'Products'],
            ['name' => 'update', 'section' => 'Products'],
            ['name' => 'delete', 'section' => 'Products'],
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