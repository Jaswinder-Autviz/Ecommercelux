@extends('admin.layouts.admin')

@section('admin_content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Instagram Reels</h1>
            <p class="text-sm text-gray-500">Manage reels shown on homepage.</p>
        </div>
    </div>

    {{-- Add Reel Form --}}
    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
        <h3 class="font-bold text-gray-900 mb-6">Add New Reel</h3>
        <form action="{{ route('admin.reels.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Thumbnail Image <span class="text-red-500">*</span></label>
                <input type="file" name="thumbnail" required accept="image/*" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Instagram Reel URL</label>
                <input type="url" name="reel_url" placeholder="https://www.instagram.com/reel/..." class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Likes (e.g. 4.2k)</label>
                <input type="text" name="likes" placeholder="4.2k" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none text-sm">
            </div>
            <div class="md:col-span-3">
                <button type="submit" class="bg-primary text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-primary/20 hover:scale-[1.02] transition-all">
                    Add Reel
                </button>
            </div>
        </form>
    </div>

    {{-- Reels Grid --}}
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @forelse($reels as $reel)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="aspect-[9/16] relative">
                <img src="{{ asset('assets/images/reels/' . $reel->thumbnail) }}" class="w-full h-full object-cover">
                <div class="absolute top-2 left-2 bg-black/50 text-white text-[10px] font-bold px-2 py-1 rounded-lg">❤ {{ $reel->likes }}</div>
            </div>
            <div class="p-3 flex items-center justify-between">
                <a href="{{ $reel->reel_url }}" target="_blank" class="text-xs text-primary font-bold truncate">View</a>
                <form action="{{ route('admin.reels.destroy', $reel->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-400 hover:text-red-600 text-xs font-bold">Delete</button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-6 text-center py-10 text-gray-400">No reels added yet.</div>
        @endforelse
    </div>
</div>
@endsection
