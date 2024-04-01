<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'contact_number',
        'gender',
        'email',
        'city',
        'country',
        'notes',
        'last_update',
    ];

    public function orders()
{
    return $this->hasMany(Order::class);
}

}
