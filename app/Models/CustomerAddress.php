<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'full_name',
        'mobile_number',
        'alternate_number',
        'pincode',
        'state',
        'city',
        'street_address',
        'landmark',
        'address_type',
        'is_default',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
