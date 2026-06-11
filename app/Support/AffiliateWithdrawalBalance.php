<?php

namespace App\Support;

use App\Models\Affiliate;
use App\Models\AffiliateOrder;
use App\Models\AffiliateWithdrawal;

class AffiliateWithdrawalBalance
{
    public static function for(Affiliate $affiliate): array
    {
        $approvedCommission = (float) AffiliateOrder::where('affiliate_id', $affiliate->id)
            ->whereIn('status', ['completed', 'approved'])
            ->sum('commission_amount');

        $totalCommission = max($approvedCommission, (float) $affiliate->total_commission);

        $paidCommission = (float) AffiliateWithdrawal::where('affiliate_id', $affiliate->id)
            ->where('status', 'paid')
            ->sum('amount');

        $pendingWithdrawal = (float) AffiliateWithdrawal::where('affiliate_id', $affiliate->id)
            ->whereIn('status', ['pending', 'approved'])
            ->sum('amount');

        $availableBalance = max($totalCommission - $paidCommission - $pendingWithdrawal, 0);

        return [
            'total_commission' => round($totalCommission, 2),
            'paid_commission' => round($paidCommission, 2),
            'pending_withdrawal' => round($pendingWithdrawal, 2),
            'available_balance' => round($availableBalance, 2),
        ];
    }
}
