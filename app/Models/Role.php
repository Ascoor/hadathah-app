<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'arabic_name'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }


    // إذا كنت تريد تحديد العلاقات مع المستخدمين، يمكنك إضافة هذا الكود:
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
}
