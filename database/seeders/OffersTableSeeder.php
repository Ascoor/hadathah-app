<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OffersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // حذف البيانات القديمة
        DB::table('offers')->delete();

        // جلب معرفات المندوبين
        $saleReps = DB::table('sale_reps')->pluck('id')->toArray();

        // التأكد من وجود مندوبين
        if (empty($saleReps)) {
            return;
        }

        // إنشاء عروض جديدة
        $offers = [];

        for ($i = 1; $i <= 6; $i++) {
            $offers[] = [
                'id' => $i,
                'offer_number' => 'HA-' . strtoupper(Str::random(10)),
                'customer_id' => rand(1, 10),
                'sale_rep_id' => $saleReps[array_rand($saleReps)], // اختيار عشوائي لمعرف المندوب
                'offer_date' => now()->subDays(rand(1, 30)),
                'products' => json_encode([
                    ['product_id' => rand(1, 10), 'quantity' => rand(1, 50), 'notes' => Str::random(10)],
                    ['product_id' => rand(1, 10), 'quantity' => rand(1, 50), 'notes' => Str::random(10)],
                ]),
                'total' => rand(1000, 50000),
                'tax_rate' => 12.00,
                'discount_rate' => 11.00,
                'total_final' => rand(900, 45000),
                'payment_method' => 'visa',
                'payment_type' => 'partial',
                'is_active' => 1,
                'valid_until' => now()->addDays(rand(1, 30)),
                'time_plementation_range' => '30',
                'status' => 'active',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // إدخال العروض في الجدول
        DB::table('offers')->insert($offers);
    }
}
