<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialRepsTableSeeder extends Seeder
{
    public function run()
    {$socialReps = [
        ['مها العتيبي', '0581234567', 'maha.alotaibi@example.com', 'maha123', null, 'إدارة وسائل التواصل الاجتماعي, إنشاء المحتوى'],
        ['أحمد الناصر', '0572345678', 'ahmed.alnasser@example.com', 'ahmed2024', null, 'التسويق الرقمي, تحسين محركات البحث (SEO)'],
        ['ريما الخليفة', '0563456789', 'reema.alkhalifa@example.com', 'reemaPass', null, 'تصميم جرافيك, Adobe Photoshop'],
        ['فيصل السعود', '0554567890', 'faisal.alsaud@example.com', 'faisal2024', null, 'إنتاج الفيديو, التحرير'],
        ['ليان الباكر', '0545678901', 'layan.albaker@example.com', 'layan123', null, 'التواصل مع المؤثرين, شراكات العلامة التجارية'],
        ['عمر الفضل', '0536789012', 'omar.alfadl@example.com', 'omarPass', null, 'كتابة الإعلانات, التدوين'],
        ['هالة الخاشقجي', '0527890123', 'hala.alkhashoggi@example.com', 'hala2024', null, 'تخطيط الفعاليات, العلاقات العامة'],
        ['خليل الفهيم', '0518901234', 'khalil.alfahim@example.com', 'khalil123', null, 'تطوير الويب, JavaScript'],
        ['سارة الشريف', '0599012345', 'sara.alsharif@example.com', 'saraPass', null, 'تصميم واجهة المستخدم/تجربة المستخدم, Figma'],
        ['نواف التميمي', '0580123456', 'nawaf.altamimi@example.com', 'nawaf2024', null, 'التصوير الفوتوغرافي, Adobe Lightroom'],
    ];
    

        foreach ($socialReps as $rep) {
            DB::table('social_reps')->insert([
                'name' => $rep[0],
                'phone' => $rep[1],
                'email' => $rep[2],
                'password' => bcrypt($rep[3]), // Remember to hash the password
                'image' => $rep[4],
                'skills' => $rep[5],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
