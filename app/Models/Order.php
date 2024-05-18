<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'customer_id',
        'sale_rep_id',
        'designer_id',
        'order_date',
        'order_type',
        'is_commission',
        'total',
        'tax_rate',
        'discount_rate',
        'total_final',
        'payment_status',
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

    public function saleRep()
    {
        return $this->belongsTo(SaleRep::class, 'sale_rep_id');
    }

    public function designer()
    {
        return $this->belongsTo(Designer::class, 'designer_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
