<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // إنشاء سجل للدور "مصمم"
        $designer = new Role();
        $designer->name = 'Designers';
        $designer->save();

        // إنشاء سجل للدور "مندوب مبيعات"
        $salesRep = new Role();
        $salesRep->name = 'SaleReps';
        $salesRep->save();

        // إنشاء سجل للدور "مندوب اجتماعي"
        $socialRep = new Role();
        $socialRep->name = 'SocialReps';
        $socialRep->save();

        // إنشاء سجل للدور "مدير"
        $admin = new Role();
        $admin->name = 'Admin';
        $admin->save();
    }
}
