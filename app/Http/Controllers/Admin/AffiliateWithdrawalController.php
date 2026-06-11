<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AffiliateWithdrawal;
use Illuminate\Http\Request;

class AffiliateWithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = AffiliateWithdrawal::with('affiliate')->latest()->paginate(15);

        return view('admin.affiliate-withdrawals.index', compact('withdrawals'));
    }

    public function approve($id)
    {
        $withdrawal = AffiliateWithdrawal::findOrFail($id);

        if ($withdrawal->isPaid()) {
            return back()->with('error', 'Paid withdrawal requests cannot be changed.');
        }

        if ($withdrawal->status === 'rejected') {
            return back()->with('error', 'Rejected withdrawal requests cannot be approved.');
        }

        $withdrawal->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Withdrawal request approved.');
    }

    public function markPaid(Request $request, $id)
    {
        $withdrawal = AffiliateWithdrawal::findOrFail($id);

        if ($withdrawal->isPaid()) {
            return back()->with('error', 'This withdrawal request is already paid.');
        }

        if ($withdrawal->status === 'rejected') {
            return back()->with('error', 'Rejected withdrawal requests cannot be marked as paid.');
        }

        $data = $request->validate([
            'payment_reference' => ['nullable', 'string', 'max:255'],
        ]);

        $withdrawal->update([
            'status' => 'paid',
            'payment_reference' => $data['payment_reference'] ?? null,
            'approved_at' => $withdrawal->approved_at ?: now(),
            'paid_at' => now(),
        ]);

        return back()->with('success', 'Withdrawal request marked as paid.');
    }

    public function reject(Request $request, $id)
    {
        $withdrawal = AffiliateWithdrawal::findOrFail($id);

        if ($withdrawal->isPaid()) {
            return back()->with('error', 'Paid withdrawal requests cannot be changed.');
        }

        $data = $request->validate([
            'admin_note' => ['required', 'string', 'max:1000'],
        ]);

        $withdrawal->update([
            'status' => 'rejected',
            'admin_note' => $data['admin_note'],
            'rejected_at' => now(),
        ]);

        return back()->with('success', 'Withdrawal request rejected.');
    }
}
