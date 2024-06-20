<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiEmployee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'user_id',
        'image',
        'position',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function Offers()
    {
        return $this->hasMany(Offer::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
