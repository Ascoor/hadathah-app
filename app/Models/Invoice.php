<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $primaryKey = 'invoice_id';
    protected $fillable = [  
           'invoice_date',
    'invoice_number',
    'order_id',
    'customer_id',
    'total_before_discount_and_tax',
    'total_after_discount_and_tax',
    'discount_amount',
    'tax_amount',
    'status',
];

public static function generateInvoiceNumber()
{
    $lastInvoice = self::orderBy('created_at', 'desc')->first();

    if (!$lastInvoice) {
        $number = 1;
    } else {
        $lastNumber = (int)substr($lastInvoice->invoice_number, 5);
        $number = $lastNumber + 1;
    }

    return 'INHA-' . str_pad($number, 8, '0', STR_PAD_LEFT);
}

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function details()
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'invoice_id');
    }
  // Relationship to Order
  public function order()
  {
      return $this->belongsTo(Order::class, 'order_id', 'order_id');
  }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'invoice_id', 'invoice_id');
    }
}