<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Affiliate extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'social_media_url',
        'password',
        'coupon_code',
        'commission_type',
        'commission_value',
        'status',
        'total_orders',
        'total_sales',
        'total_commission',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'commission_value' => 'decimal:2',
        'total_sales' => 'decimal:2',
        'total_commission' => 'decimal:2',
    ];

    public function orders()
    {
        return $this->hasMany(AffiliateOrder::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(AffiliateWithdrawal::class);
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function calculateCommission(float $amount): float
    {
        if ($this->commission_type === 'percentage') {
            return round(($amount * (float) $this->commission_value) / 100, 2);
        }

        return round((float) $this->commission_value, 2);
    }
}
