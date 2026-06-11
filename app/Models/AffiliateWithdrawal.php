<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateWithdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'affiliate_id',
        'amount',
        'payment_method',
        'gpay_upi_id',
        'note',
        'status',
        'admin_note',
        'payment_reference',
        'requested_at',
        'approved_at',
        'paid_at',
        'rejected_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'requested_at' => 'datetime',
        'approved_at' => 'datetime',
        'paid_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }
}
