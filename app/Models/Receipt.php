<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{

    use HasFactory;

    protected $primaryKey = 'receipt_id';
    protected $fillable = ['customer_id', 'receipt_date', 'amount', 'receipt_method'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
}
