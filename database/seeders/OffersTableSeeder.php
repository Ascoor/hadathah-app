<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offers')->delete();

        $offers = [];
        for ($i = 1; $i <= 5; $i++) {
            $offers[] = [
                'id' => $i,
                'offer_number' => 'HA-001796387' . $i, // Generate unique offer numbers
                'customer_id' => 9,
                'sale_rep_id' => 1,
                'offer_date' => '2024-05-02 23:59:00',
                'products' => '[{"product_id":5,"quantity":23,"notes":"ds"},{"product_id":5,"quantity":23,"notes":"ds"},{"product_id":5,"quantity":23,"notes":"ds"},{"product_id":5,"quantity":23,"notes":"ds"},{"product_id":3,"quantity":2,"notes":"df"}]',
                'total' => '320372.00',
                'tax_rate' => '12.00',
                'discount_rate' => '11.00',
                'total_final' => '319346.81',
                'payment_method' => 'visa',
                'payment_type' => 'partial',
                'is_active' => 1,
                'valid_until' => '2024-06-03 00:00:00',
                'time_plementation_range' => '30',
                'status' => 'active',
                'created_by' => 1,
                'created_at' => '2024-05-03 00:00:29',
                'updated_at' => '2024-05-03 00:00:29',
            ];
        }

        DB::table('offers')->insert($offers);
    }
}