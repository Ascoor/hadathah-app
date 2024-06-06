<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialRep extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'user_id',
        'image',
        'skills',
    ];
}
