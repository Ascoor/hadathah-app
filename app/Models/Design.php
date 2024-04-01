<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'designer_id',
        'details',
        'review',
        'modifications',
   'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function designer()
    {
        return $this->belongsTo(Designer::class);
    }
}
