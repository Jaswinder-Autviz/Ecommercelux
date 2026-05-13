@extends('admin.layouts.admin')

@section('admin_content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Customers</h1>
            <p class="text-sm text-gray-500">View and manage registered customers and their records.</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-[10px] uppercase tracking-wider text-gray-400 font-bold">
                        <th class="px-8 py-4">Customer Info</th>
                        <th class="px-8 py-4">Phone</th>
                        <th class="px-8 py-4 text-center">Orders</th>
                        <th class="px-8 py-4 text-center">Addresses</th>
                        <th class="px-8 py-4">Joined Date</th>
                        <th class="px-8 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($customers as $customer)
                    <tr class="hover:bg-gray-50 transition-all group">
                        <td class="px-8 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                                    {{ strtoupper(substr($customer->name ?? 'G', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900">{{ $customer->name ?? 'Guest User' }}</p>
                                    <p class="text-[11px] text-gray-400">{{ $customer->email ?? 'No Email' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-4 text-sm text-gray-600 font-medium">
                            +91 {{ $customer->phone }}
                        </td>
                        <td class="px-8 py-4 text-center">
                            <span class="px-2 py-1 bg-blue-50 text-blue-500 text-[10px] font-bold rounded-lg">{{ $customer->orders_count }}</span>
                        </td>
                        <td class="px-8 py-4 text-center">
                            <span class="px-2 py-1 bg-purple-50 text-purple-500 text-[10px] font-bold rounded-lg">{{ $customer->addresses_count }}</span>
                        </td>
                        <td class="px-8 py-4 text-sm text-gray-400">
                            {{ $customer->created_at->format('d M, Y') }}
                        </td>
                        <td class="px-8 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.customers.show', $customer->id) }}" class="p-2 text-gray-400 hover:text-primary transition-all">
                                    <i class="far fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Delete customer record?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-500 transition-all">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-10 text-center text-gray-400 italic">No registered customers found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 border-t border-gray-50">
            {{ $customers->links() }}
        </div>
    </div>
</div>
@endsection
