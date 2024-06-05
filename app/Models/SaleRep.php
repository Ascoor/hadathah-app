<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleRep extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',

        'user_id',
        'image',
        'covered_areas',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
