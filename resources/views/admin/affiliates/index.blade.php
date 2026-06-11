@extends('admin.layouts.admin')

@section('admin_content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Affiliators</h1>
            <p class="text-sm text-gray-500">Approve partners, manage coupon codes, and track commission.</p>
        </div>
        <a href="{{ route('admin.affiliates.create') }}" class="inline-flex items-center justify-center rounded-xl bg-primary px-4 py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 transition-all hover:scale-[1.02]">
            <i class="fas fa-plus mr-2"></i> Add Affiliator
        </a>
    </div>

    <div class="grid gap-4 md:grid-cols-4">
        <div class="stat-card rounded-2xl border bg-white p-5">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Total</p>
            <p class="mt-2 text-2xl font-extrabold text-gray-950">{{ $affiliates->total() }}</p>
        </div>
        <div class="stat-card rounded-2xl border bg-white p-5">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Approved</p>
            <p class="mt-2 text-2xl font-extrabold text-green-600">{{ \App\Models\Affiliate::where('status', 'approved')->count() }}</p>
        </div>
        <div class="stat-card rounded-2xl border bg-white p-5">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Sales</p>
            <p class="mt-2 text-2xl font-extrabold text-gray-950">Rs. {{ number_format(\App\Models\Affiliate::sum('total_sales'), 2) }}</p>
        </div>
        <div class="stat-card rounded-2xl border bg-white p-5">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Commission</p>
            <p class="mt-2 text-2xl font-extrabold text-primary">Rs. {{ number_format(\App\Models\Affiliate::sum('total_commission'), 2) }}</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-[11px] font-bold uppercase tracking-wider text-gray-400">
                        <th class="px-6 py-4">Affiliator</th>
                        <th class="px-6 py-4">Coupon</th>
                        <th class="px-6 py-4">Commission</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Performance</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($affiliates as $affiliate)
                        <tr class="transition-all hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <p class="text-sm font-extrabold text-gray-900">{{ $affiliate->name }}</p>
                                <p class="text-xs text-gray-400">{{ $affiliate->email }}{{ $affiliate->phone ? ' - ' . $affiliate->phone : '' }}</p>
                                @if($affiliate->social_media_url)
                                    <a href="{{ $affiliate->social_media_url }}" target="_blank" rel="noopener noreferrer" class="mt-1 inline-flex text-xs font-bold text-primary hover:text-gray-950">
                                        Social Profile
                                    </a>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-gray-950 px-3 py-1 text-xs font-extrabold uppercase tracking-widest text-white">{{ $affiliate->coupon_code }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-gray-700">
                                {{ $affiliate->commission_type === 'percentage' ? $affiliate->commission_value . '%' : 'Rs. ' . number_format($affiliate->commission_value, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClass = ['approved' => 'bg-green-50 text-green-700', 'pending' => 'bg-amber-50 text-amber-700', 'rejected' => 'bg-red-50 text-red-600'][$affiliate->status] ?? 'bg-gray-100 text-gray-600';
                                @endphp
                                <span class="rounded-full px-3 py-1 text-xs font-extrabold uppercase {{ $statusClass }}">{{ $affiliate->status }}</span>
                            </td>
                            <td class="px-6 py-4 text-right text-xs font-bold text-gray-500">
                                <p>{{ $affiliate->total_orders }} orders</p>
                                <p>Rs. {{ number_format($affiliate->total_sales, 2) }} sales</p>
                                <p class="text-primary">Rs. {{ number_format($affiliate->total_commission, 2) }} commission</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    @if($affiliate->status !== 'approved')
                                        <form action="{{ route('admin.affiliates.approve', $affiliate) }}" method="POST">@csrf
                                            <button class="h-8 w-8 rounded-lg bg-green-50 text-green-600 transition-all hover:bg-green-100" title="Approve"><i class="fas fa-check text-xs"></i></button>
                                        </form>
                                    @endif
                                    @if($affiliate->status !== 'rejected')
                                        <form action="{{ route('admin.affiliates.reject', $affiliate) }}" method="POST">@csrf
                                            <button class="h-8 w-8 rounded-lg bg-amber-50 text-amber-600 transition-all hover:bg-amber-100" title="Reject"><i class="fas fa-ban text-xs"></i></button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.affiliates.edit', $affiliate) }}" class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-500 transition-all hover:bg-blue-100">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.affiliates.destroy', $affiliate) }}" method="POST" onsubmit="return confirm('Delete this affiliator?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="h-8 w-8 rounded-lg bg-red-50 text-red-500 transition-all hover:bg-red-100"><i class="fas fa-trash text-xs"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-6 py-10 text-center text-gray-400">No affiliators found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-50 p-6">{{ $affiliates->links() }}</div>
    </div>
</div>
@endsection
