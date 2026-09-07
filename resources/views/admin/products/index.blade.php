@extends('admin.layouts.admin')

@section('admin_content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Products</h1>
            <p class="text-sm text-gray-500">Manage your store products and inventory.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">
            <i class="fas fa-plus mr-2"></i> Add New Product
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="relative flex-1 max-w-md">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <i class="fas fa-search text-xs"></i>
                </span>
                <input type="text" class="block w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary sm:text-sm transition-all" placeholder="Search product name, SKU...">
            </div>
            <div class="flex items-center gap-3">
                <select class="bg-gray-50 border border-gray-200 text-gray-600 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2 transition-all">
                    <option selected>All Categories</option>
                    <option value="abstract">Abstract</option>
                    <option value="minimalist">Minimalist</option>
                    <option value="nature">Nature</option>
                    <option value="modern-art">Modern Art</option>
                </select>
                <select class="bg-gray-50 border border-gray-200 text-gray-600 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2 transition-all">
                    <option selected>Status: All</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-[11px] uppercase tracking-wider font-bold">
                        <th class="px-6 py-4">Product</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Price</th>
                        <th class="px-6 py-4">Stock</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition-all group">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('assets/images/products/' . $product->main_image) }}" class="w-12 h-12 rounded-lg object-cover border border-gray-100">
                                <div>
                                    <p class="text-sm font-bold text-gray-900 group-hover:text-primary transition-all">{{ $product->name }}</p>
                                    <p class="text-[11px] text-gray-400">SKU: {{ $product->sku }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-900">₹{{ number_format($product->price) }}</div>
                            @if($product->discount_price)
                            <div class="text-[10px] text-red-400 line-through">₹{{ number_format($product->discount_price) }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-medium {{ $product->stock_quantity < 10 ? 'text-red-500' : 'text-gray-600' }}">
                                    {{ $product->stock_quantity }}
                                </span>
                                <div class="w-16 h-1 bg-gray-100 rounded-full mt-1 overflow-hidden">
                                    <div class="h-full bg-{{ $product->stock_quantity < 10 ? 'red' : 'green' }}-500" style="width: {{ min($product->stock_quantity, 100) }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-tighter {{ $product->status ? 'bg-green-50 text-green-500' : 'bg-gray-100 text-gray-400' }}">
                                {{ $product->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm ">
                            {{ $product->created_at->format('d M, Y') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50  hover:bg-blue-50 hover:text-blue-500 transition-all">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50 hover:bg-red-50 hover:text-red-500 transition-all">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center italic">No products found. Start by adding one!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-6 border-t border-gray-50 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <p class="text-sm text-gray-500">
                Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
            </p>
            <div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
