<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        
        $this->call(PasswordsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);

        $this->call(CustomerSeeder::class);
        $this->call(DesignersTableSeeder::class);

        $this->call(SaleRepsTableSeeder::class);
        $this->call(SocialRepsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(OffersTableSeeder::class);
    }
}
