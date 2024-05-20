<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    
        protected $fillable = [
            'offer_number',
            'customer_id',
            'sale_rep_id',
            'offer_date',
            'products',
            'total',
            'tax_rate',
            'discount_rate',
            'total_final',
            'payment_method',
            'payment_type',
            'is_active',
            'time_plementation_range',
            'valid_until',
            'status',
            'created_by',
        ];
    

        protected $casts = [
            'offer_date' => 'datetime',
            'valid_until' => 'datetime',
            'products' => 'array', // Assuming products are stored as JSON
            'is_active' => 'boolean',
        ];
    
        // Relationships

        public function customer()
        {
            return $this->belongsTo(Customer::class);
        }
    
        public function saleRep()
        {
            return $this->belongsTo(SaleRep::class, 'sale_rep_id');
        }
        
                 public function creator()
        {
            return $this->belongsTo(User::class, 'created_by');
        }
    }