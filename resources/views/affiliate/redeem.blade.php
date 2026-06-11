@extends('affiliate.layout')

@section('title', 'Redeem Commission - Hustler')

@section('content')
<div class="space-y-7">
    <div>
        <p class="text-sm font-bold uppercase tracking-widest text-primary">Redeem</p>
        <h1 class="mt-1 text-3xl font-bold text-gray-950">GPay/UPI Withdrawal</h1>
        <p class="mt-2 max-w-2xl text-sm leading-6 text-gray-500">Withdraw available affiliate commission directly to your GPay/UPI ID. Minimum redeem amount is Rs. 10.</p>
    </div>

    <div class="grid gap-4 md:grid-cols-4">
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Total Commission</p>
            <p class="mt-3 text-2xl font-extrabold text-gray-950">Rs. {{ number_format($balance['total_commission'], 2) }}</p>
        </div>
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Paid Commission</p>
            <p class="mt-3 text-2xl font-extrabold text-gray-950">Rs. {{ number_format($balance['paid_commission'], 2) }}</p>
        </div>
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Pending Withdrawal</p>
            <p class="mt-3 text-2xl font-extrabold text-gray-950">Rs. {{ number_format($balance['pending_withdrawal'], 2) }}</p>
        </div>
        <div class="rounded-2xl border border-primary/20 bg-primary p-5 text-white shadow-lg shadow-primary/20">
            <p class="text-xs font-bold uppercase tracking-widest text-white/70">Available Balance</p>
            <p class="mt-3 text-2xl font-extrabold">Rs. {{ number_format($balance['available_balance'], 2) }}</p>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-[0.9fr_1.1fr]">
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            <h2 class="font-extrabold text-gray-950">Request Redeem</h2>
            <p class="mt-1 text-sm text-gray-500">GPay/UPI only. Bank transfer is not available.</p>

            @if($errors->any())
                <div class="mt-5 rounded-xl border border-red-100 bg-red-50 p-4 text-sm font-bold text-red-600">
                    <ul class="list-inside list-disc space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('affiliate.redeem.store') }}" method="POST" class="mt-6 space-y-5">
                @csrf
                <div>
                    <label class="mb-2 block text-sm font-bold text-gray-700">Amount</label>
                    <input type="number" name="amount" min="10" step="0.01" value="{{ old('amount') }}" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-bold outline-none transition-all" placeholder="Minimum Rs. 10">
                    <p class="mt-2 text-xs font-semibold text-gray-400">Maximum available: Rs. {{ number_format($balance['available_balance'], 2) }}</p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-bold text-gray-700">GPay / UPI ID</label>
                    <input type="text" name="gpay_upi_id" value="{{ old('gpay_upi_id') }}" required class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-bold outline-none transition-all" placeholder="name@okaxis">
                    <p class="mt-2 text-xs font-semibold text-gray-400">Examples: name@okaxis, mobile@oksbi, name@okhdfcbank</p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-bold text-gray-700">Note <span class="text-gray-400">(optional)</span></label>
                    <textarea name="note" rows="3" class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition-all" placeholder="Any note for admin">{{ old('note') }}</textarea>
                </div>

                <button type="submit" class="w-full rounded-xl bg-primary px-5 py-3 text-sm font-extrabold text-white shadow-lg shadow-primary/20 transition-all hover:scale-[1.01] disabled:cursor-not-allowed disabled:opacity-50" @disabled($balance['available_balance'] < 10)>
                    Submit Redeem Request
                </button>
            </form>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
            <div class="border-b border-gray-100 px-6 py-4">
                <h2 class="font-extrabold text-gray-950">Withdrawal History</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 text-[11px] font-bold uppercase tracking-wider text-gray-400">
                            <th class="px-5 py-4">Amount</th>
                            <th class="px-5 py-4">GPay UPI ID</th>
                            <th class="px-5 py-4">Status</th>
                            <th class="px-5 py-4">Admin Note</th>
                            <th class="px-5 py-4">Requested Date</th>
                            <th class="px-5 py-4">Paid Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($withdrawals as $withdrawal)
                            <tr>
                                <td class="px-5 py-4 text-sm font-extrabold text-gray-900">Rs. {{ number_format($withdrawal->amount, 2) }}</td>
                                <td class="px-5 py-4 text-sm font-bold text-gray-600">{{ $withdrawal->gpay_upi_id }}</td>
                                <td class="px-5 py-4">
                                    <span class="rounded-full px-3 py-1 text-[10px] font-extrabold uppercase {{ $withdrawal->status === 'paid' ? 'bg-green-50 text-green-700' : ($withdrawal->status === 'rejected' ? 'bg-red-50 text-red-600' : 'bg-amber-50 text-amber-700') }}">{{ $withdrawal->status }}</span>
                                </td>
                                <td class="px-5 py-4 text-sm text-gray-500">{{ $withdrawal->admin_note ?: '-' }}</td>
                                <td class="px-5 py-4 text-sm text-gray-500">{{ optional($withdrawal->requested_at ?? $withdrawal->created_at)->format('d M Y') }}</td>
                                <td class="px-5 py-4 text-sm text-gray-500">{{ $withdrawal->paid_at?->format('d M Y') ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-5 py-10 text-center text-gray-400">No withdrawal requests yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-gray-50 p-6">{{ $withdrawals->links() }}</div>
        </div>
    </div>
</div>
@endsection
