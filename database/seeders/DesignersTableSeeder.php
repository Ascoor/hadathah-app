<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Designer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DesignersTableSeeder extends Seeder
{
    public function run()
    {
$designers = [
    ['أحمد حسن', '01012345678', 'ahmed.hassan@example.com', 'mySecurePassword', 'https://example.com/images/ahmed.png', 'تصميم جرافيك, Adobe Photoshop'],
    ['محمد فتحي', '01023456789', 'mohamed.fathy@example.com', 'password123', 'https://example.com/images/mohamed.png', 'UI/UX, Figma'],
    ['سارة محمود', '01034567890', 'sara.mahmoud@example.com', 'saraPass', null, 'تصميم ويب, HTML, CSS'],
    ['آية علي', '01045678901', 'aya.ali@example.com', 'aya2024', null, 'تصميم داخلي, AutoCAD'],
    ['عمر خالد', '01056789012', 'omar.khaled@example.com', 'omarPass', null, 'تصميم أزياء, الخياطة'],
    ['نور الدين', '01067890123', 'nour.eldeen@example.com', 'nourSecure', null, 'تصميم المنتجات, الطباعة ثلاثية الأبعاد'],
    ['ليلى سامي', '01078901234', 'laila.samy@example.com', 'laila123', null, 'تصميم جرافيك, الرسم'],
    ['كريم مصطفى', '01089012345', 'kareem.mostafa@example.com', 'kareemPass', null, 'الرسوم المتحركة, الرسوم المتحركة ثلاثية الأبعاد'],
    ['فاطمة حسين', '01090123456', 'fatma.hussien@example.com', 'fatma2024', null, 'التصوير الفوتوغرافي, Adobe Lightroom'],
    ['طارق الشيخ', '01001234567', 'tarek.el.sheikh@example.com', 'tarekPass', null, 'التصوير السينمائي, Adobe Premiere'],
    ['مريم عبدالله', '01012345678', 'mariem.ahmed@example.com', 'mariemPass', null, 'التصوير الفوتوغرافي, Adobe Lightroom'],
];
        foreach ($designers as $designer) {
            DB::table('designers')->insert([
                'name' => $designer[0],
                'phone' => $designer[1],
                'email' => $designer[2],
                'password' => bcrypt($designer[3]), // Remember to hash the password
                'image' => $designer[4],
                'skills' => $designer[5],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            }    }
}