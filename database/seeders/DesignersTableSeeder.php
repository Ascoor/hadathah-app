<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Designer;
use App\Models\Password; // Import the Password model
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DesignersTableSeeder extends Seeder
{
    public function run()
    {
        // Seed passwords table
        $passwords = [
            'mySecurePassword',
            'password123',
            'saraPass',
            'aya2024',
            'omarPass',
            'nourSecure',
            'laila123',
            'kareemPass',
            'fatma2024',
            'tarekPass',
            'mariemPass',
        ];

        foreach ($passwords as $password) {
            Password::create([
                'password' => Hash::make($password),
            ]);
        }

        // Seed designers table
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
            // Find the password ID by matching the hashed password
            $password = $designer[3];
            $passwordModel = Password::where('password', Hash::make($password))->first();

            // If the password exists, get its ID
            // Otherwise, create a new password and get its ID
            if ($passwordModel) {
                $passwordId = $passwordModel->id;
            } else {
                $passwordId = Password::create([
                    'password' => Hash::make($password),
                ])->id;
            }

            // Insert the designer record with the password ID
            DB::table('designers')->insert([
                'name' => $designer[0],
                'phone' => $designer[1],
                'email' => $designer[2],
                'password_id' => $passwordId,
                'image' => $designer[4],
                'skills' => $designer[5],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}