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
            'order_add', 'order_update', 'order_delete',
            'customer_add', 'customer_update', 'customer_delete',
            'design_add', 'design_update', 'design_delete',
            'socialRep_add', 'socialRep_update', 'socialRep_delete',
            'saleRep_add', 'saleRep_update', 'saleRep_delete',
            'offer_add', 'offer_update', 'offer_delete','product_add', 'product_update', 'product_delete','category_add', 'category_update', 'category_delete'
        ];
        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'name' => $permission,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
