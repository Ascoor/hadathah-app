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
        'email',
        'image',
        'skills',
    ];
    public function designs()
    {
        return $this->hasMany(Design::class);
    }
    
}
