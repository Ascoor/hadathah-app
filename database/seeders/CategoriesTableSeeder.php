<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('categories')->delete();
        
        DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'الحملات الترويجية المتكاملة',
                'description' => 'خدمات تصميم وتنفيذ حملات إعلانية شاملة تتضمن استراتيجيات التسويق الرقمي والتقليدي. تشمل الخدمات تصميم الرسومات، إنتاج المحتوى الإعلامي، وإدارة الحملات عبر مختلف المنصات لضمان أقصى تأثير.',
                'image' => '/storage/categories/c47vf9XCS8nyDZaye5MgRIGxstkK5Wl1t7CXbcBT.png',
                'created_at' => '2024-05-02 22:56:34',
                'updated_at' => '2024-05-02 23:20:30',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'تصميم الهوية البصرية',
                'description' => 'تطوير وتصميم الهويات البصرية للعلامات التجارية الجديدة أو تحديث الهويات القائمة. تشمل الخدمات تصميم الشعارات، البطاقات التجارية، الكتيبات، والمواد الترويجية الأخرى التي تعكس قيم ورؤية الشركة.',
                'image' => '/storage/categories/Ewl0XA8mp5ulyuasbwPS3TNEAEq9lgBIORjarUXs.png',
                'created_at' => '2024-05-02 22:57:03',
                'updated_at' => '2024-05-02 23:19:27',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'حلول التسويق الرقمي',
                'description' => 'وضع إستراتيجيات التسويق الرقمي بما في ذلك SEO، تسويق المحتوى، التسويق عبر وسائل التواصل الاجتماعي، والحملات الإعلانية عبر الإنترنت. يهدف هذا التصنيف إلى تعزيز الحضور الإلكتروني للعلامات التجارية وزيادة التفاعل مع الجمهور المستهدف.',
                'image' => '/storage/categories/knJB9RZDg0CXUBBhwwAiCAn1VFLnR7up6lMs6bT1.png',
                'created_at' => '2024-05-02 22:57:37',
                'updated_at' => '2024-05-02 23:19:44',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'خدمات الطباعة والإنتاج',
                'description' => 'خدمات الطباعة والإنتاج بما في ذلك طباعة الملصقات، اللافتات، البروشورات، والمواد الترويجية الأخرى. يتم استخدام أحدث التقنيات لضمان جودة ودقة عالية في الإنتاج.',
                'image' => '/storage/categories/zM8Cc8arimo6UkELhRnXec0Ukid9ge5PyaEZFJBD.png',
                'created_at' => '2024-05-02 22:58:04',
                'updated_at' => '2024-05-02 23:19:56',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'إستشارات التسويق والعلامات التجارية',
                'description' => 'خدمات استشارية متخصصة في التسويق وتطوير العلامات التجارية. تشمل الخدمات تحليل السوق، تطوير استراتيجيات التسويق، وتقديم الدعم في صنع القرارات التجارية لتحسين الأداء والنمو في السوق.',
                'image' => '/storage/categories/pNpXGyo66IKIrysmNWRINRHvHsemd3G11ddI4PGK.png',
                'created_at' => '2024-05-02 22:58:26',
                'updated_at' => '2024-05-02 23:20:14',
            ),
        ));
        
        
    }
}