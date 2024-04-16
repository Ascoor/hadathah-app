<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleRepsTableSeeder extends Seeder
{
    public function run()
    {
        $saleReps = [
            ['فهد الغامدي', '0567890123', 'fahad.alghamdi@example.com', 'fahad123', null, 'الرياض, جدة'],
            ['سعود الشمري', '0556789012', 'saud.alshammari@example.com', 'saud2024', null, 'الدمام, الخبر'],
            ['نورا الفيصل', '0545678901', 'nora.alfaisal@example.com', 'noraPass', null, 'مكة, المدينة'],
            ['لمى السليمان', '0534567890', 'lama.alsulaiman@example.com', 'lama2024', null, 'الطائف, جدة'],
            ['خالد الميوف', '0523456789', 'khalid.almayouf@example.com', 'khalidPass', null, 'الرياض, الأحساء'],
            ['حسين الجهني', '0512345678', 'hussain.aljuhani@example.com', 'hussain123', null, 'الجبيل, ينبع'],
            ['أمل القحطاني', '0598765432', 'amal.alqahtani@example.com', 'amal2024', null, 'نجران, جيزان'],
            ['يوسف النمير', '0587654321', 'yousef.alnamir@example.com', 'yousefPass', null, 'تبوك, العلا'],
            ['عبير المبارك', '0576543210', 'abeer.almubarak@example.com', 'abeer123', null, 'القصيم, حائل'],
            ['طارق الحربي', '0565432109', 'tariq.alharbi@example.com', 'tariq2024', null, 'المنطقة الشرقية, الرياض'],
        ];

        foreach ($saleReps as $rep) {
            DB::table('sale_reps')->insert([
                'name' => $rep[0],
                'phone' => $rep[1],
                'email' => $rep[2],
                'password' => bcrypt($rep[3]), // Remember to hash the password
                'image' => $rep[4],
                'covered_areas' => $rep[5],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
