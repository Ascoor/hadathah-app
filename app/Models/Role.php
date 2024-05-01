<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles'; // اسم الجدول

    protected $fillable = [
        'name', // حقول أخرى يمكنك إضافتها هنا
    ];

    // إذا كنت تريد تحديد العلاقات مع المستخدمين، يمكنك إضافة هذا الكود:
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
}
