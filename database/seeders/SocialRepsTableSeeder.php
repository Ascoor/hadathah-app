<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialRepsTableSeeder extends Seeder
{
    public function run()
    {$socialReps = [
        ['مها العتيبي', '0581234567', null, 'إدارة وسائل التواصل الاجتماعي, إنشاء المحتوى'],
        ['أحمد الناصر', '0572345678', null, 'التسويق الرقمي, تحسين محركات البحث (SEO)'],
        ['ريما الخليفة', '0563456789', null, 'تصميم جرافيك, Adobe Photoshop'],
        ['فيصل السعود', '0554567890', null, 'إنتاج الفيديو, التحرير'],
        ['ليان الباكر', '0545678901', null, 'التواصل مع المؤثرين, شراكات العلامة التجارية'],
        ['عمر الفضل', '0536789012', null, 'كتابة الإعلانات, التدوين'],
        ['هالة الخاشقجي', '0527890123', null, 'تخطيط الفعاليات, العلاقات العامة'],
        ['خليل الفهيم', '0518901234', null, 'تطوير الويب, JavaScript'],
        ['سارة الشريف', '0599012345', null, 'تصميم واجهة المستخدم/تجربة المستخدم, Figma'],
        ['نواف التميمي', '0580123456', null, 'التصوير الفوتوغرافي, Adobe Lightroom'],
    ];
    

        foreach ($socialReps as $rep) {
            DB::table('social_reps')->insert([
                'name' => $rep[0],
                'phone' => $rep[1],
               'image' => $rep[2],
                'skills' => $rep[3],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
