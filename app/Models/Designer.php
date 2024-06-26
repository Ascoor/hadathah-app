<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'phone',
        'user_id',
        'image',
        'skills',
    ];
    public function designs()
    {
        return $this->hasMany(Design::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
