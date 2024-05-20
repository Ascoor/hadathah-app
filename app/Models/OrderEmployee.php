<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderEmployee extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_rep_id',
        'social_rep_id',
        'designer_id',
        'order_id',
    ];

    public function saleRep()
    {
        return $this->belongsTo(SaleRep::class);
    }

    public function socialRep()
    {
        return $this->belongsTo(SocialRep::class);
    }

    public function designer()
    {
        return $this->belongsTo(Designer::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
