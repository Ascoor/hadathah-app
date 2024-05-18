<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_id',
        'value_status',
        'payment_method',
        'payment_date',
        'notes',
        'created_by',
        'payment_status',
        'order_status',
        'paid_amount'
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
