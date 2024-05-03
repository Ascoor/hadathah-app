<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('products')->delete();
        
        DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'حملة إطلاق المنتج',
                'description' => 'ملة إعلانية شاملة لإطلاق منتج جديد، تشمل تصميم الرسوم البيانية، إعلانات الفيديو، وحملات التواصل الاجتماعي لضمان تحقيق أعلى معدلات الانتشار والتأثير.',
                'price' => '300.00',
                'image' => '/storage/products/w7xFCiJf9LmMUUR0XS8SFhEOePBMsTbIgg2LX5va.png',
                
                'category_id' => 1,
                'created_at' => '2024-05-02 23:25:04',
                'updated_at' => '2024-05-02 23:25:04',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'تعزيز العلامة التجارية',
                'description' => 'برنامج متكامل لتعزيز الهوية التجارية يشمل تحليل السوق، استراتيجيات التسويق المخصصة، وتطوير محتوى ترويجي يعكس قيم الشركة ورؤيتها.',
                'price' => '3433.00',
                'image' => '/storage/products/jBms9qaoxfI2Fz8PqBlrqeKdXlxggs8ccJhauGei.png',
                
                'category_id' => 1,
                'created_at' => '2024-05-02 23:27:06',
                'updated_at' => '2024-05-02 23:27:06',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'تصميم الشعارات',
                'description' => 'خدمة احترافية لتصميم شعارات تعبر عن العلامة التجارية بطريقة مبتكرة وجذابة، مع الأخذ بعين الاعتبار فلسفة الشركة وقيمها. منتج: حزمة الهوية التجارية',
                'price' => '2222.00',
                'image' => '/storage/products/NVuLzxX0LMH0PPhS7MMp2bJimrlEIcVMoC9BwHIu.jpg',
                
                'category_id' => 2,
                'created_at' => '2024-05-02 23:28:18',
                'updated_at' => '2024-05-02 23:28:18',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'حزمة الهوية التجارية',
                'description' => 'حزمة شاملة تتضمن تصميم الشعار، بطاقات العمل، الورق الرسمي، المظاريف، والكتيبات، مصممة لتوحيد الصورة البصرية للشركة عبر جميع نقاط التواصل.',
                'price' => '3434.00',
                'image' => '/storage/products/ifqxmypw7b8ExBHd9XFR485h8lKBLAmHkcJEYGFr.jpg',
                
                'category_id' => 2,
                'created_at' => '2024-05-02 23:32:03',
                'updated_at' => '2024-05-02 23:32:03',
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'طباعة البروشورات',
                'description' => 'طباعة بروشورات بجودة عالية، باستخدام أحدث تقنيات الطباعة لضمان ألوان زاهية وتفاصيل دقيقة تجذب الانتباه.',
                'price' => '2221.00',
                'image' => '/storage/products/HA07YWF6lStcNVXnrAqv91ISI48OAhhubxKE3mGH.png',
                
                'category_id' => 4,
                'created_at' => '2024-05-02 23:33:08',
                'updated_at' => '2024-05-02 23:33:08',
            ),
            5 => 
            array (
                'id' => 7,
                'name' => 'إنتاج اللافتات الإعلانية',
                'description' => 'خدمة إنتاج لافتات إعلانية كبيرة الحجم بمواد متينة وألوان زاهية، مثالية للحملات الخارجية والمعارض.',
                'price' => '1000.00',
                'image' => '/storage/products/AOwVOLrzFMSvJTrOwsgaKxbWUXdord3qJ7lsJoxf.png',
                
                'category_id' => 4,
                'created_at' => '2024-05-02 23:33:49',
                'updated_at' => '2024-05-02 23:33:49',
            ),
        ));
        
        
    }
}