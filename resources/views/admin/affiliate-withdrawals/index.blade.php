@extends('admin.layouts.admin')

@section('admin_content')
<div class="space-y-6">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-extrabold uppercase tracking-[0.2em] text-primary">Affiliate Payouts</p>
            <h1 class="mt-1 text-2xl font-extrabold text-gray-950">Affiliate Withdrawals</h1>
            <p class="mt-2 text-sm text-gray-500">Review GPay/UPI redeem requests and update payout status.</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-[11px] font-extrabold uppercase tracking-wider text-gray-400">
                        <th class="px-6 py-4">Affiliate Name</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">GPay UPI ID</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Requested Date</th>
                        <th class="px-6 py-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($withdrawals as $withdrawal)
                        <tr>
                            <td class="px-6 py-4 text-sm font-extrabold text-gray-900">{{ $withdrawal->affiliate?->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $withdrawal->affiliate?->email ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm font-extrabold text-gray-900">Rs. {{ number_format($withdrawal->amount, 2) }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-gray-600">{{ $withdrawal->gpay_upi_id }}</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full px-3 py-1 text-[10px] font-extrabold uppercase {{ $withdrawal->status === 'paid' ? 'bg-green-50 text-green-700' : ($withdrawal->status === 'rejected' ? 'bg-red-50 text-red-600' : ($withdrawal->status === 'approved' ? 'bg-blue-50 text-blue-700' : 'bg-amber-50 text-amber-700')) }}">{{ $withdrawal->status }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ optional($withdrawal->requested_at ?? $withdrawal->created_at)->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                @if($withdrawal->status === 'paid')
                                    <span class="text-xs font-bold uppercase tracking-widest text-gray-300">Paid</span>
                                @else
                                    <div class="flex min-w-[360px] flex-wrap gap-2">
                                        @if($withdrawal->status === 'pending')
                                            <form action="{{ route('admin.affiliate-withdrawals.approve', $withdrawal->id) }}" method="POST">
                                                @csrf
                                                <button class="rounded-xl bg-blue-50 px-3 py-2 text-xs font-extrabold text-blue-600 transition-all hover:bg-blue-100">Approve</button>
                                            </form>
                                        @endif

                                        @if(in_array($withdrawal->status, ['pending', 'approved'], true))
                                            <form action="{{ route('admin.affiliate-withdrawals.mark-paid', $withdrawal->id) }}" method="POST" class="flex gap-2">
                                                @csrf
                                                <input type="text" name="payment_reference" placeholder="Payment ref optional" class="w-40 rounded-xl border border-gray-200 px-3 py-2 text-xs font-bold outline-none">
                                                <button class="rounded-xl bg-green-50 px-3 py-2 text-xs font-extrabold text-green-700 transition-all hover:bg-green-100">Mark Paid</button>
                                            </form>

                                            <form action="{{ route('admin.affiliate-withdrawals.reject', $withdrawal->id) }}" method="POST" class="flex gap-2">
                                                @csrf
                                                <input type="text" name="admin_note" required placeholder="Reject note required" class="w-44 rounded-xl border border-gray-200 px-3 py-2 text-xs font-bold outline-none">
                                                <button class="rounded-xl bg-red-50 px-3 py-2 text-xs font-extrabold text-red-600 transition-all hover:bg-red-100">Reject</button>
                                            </form>
                                        @else
                                            <span class="text-xs font-bold uppercase tracking-widest text-gray-300">No actions</span>
                                        @endif
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-6 py-12 text-center text-gray-400">No affiliate withdrawal requests yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-50 p-6">{{ $withdrawals->links() }}</div>
    </div>
</div>
@endsection
