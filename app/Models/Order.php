<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'order_number',
        'customer_id',
        'order_date',
        'order_type',
        'is_commission',
        'total',
        'tax_rate',
        'discount_rate',
        'total_final',
        'payment_status',
        'payment_type',
        'payment_method',
        'time_plementation_range',
        'order_status',
        'updated_by',
            'created_by',
    ];

    protected $casts = [
        'order_date' => 'date',
        'is_commission' => 'boolean',
    ];

    // العلاقات
    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function details()
    {
        return $this->hasOne(OrderDetail::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function employees()
    {
        return $this->hasOne(OrderEmployee::class);
    }


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
