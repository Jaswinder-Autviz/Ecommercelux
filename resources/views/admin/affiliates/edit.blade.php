@extends('admin.layouts.admin')

@section('admin_content')
<div class="max-w-3xl space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.affiliates.index') }}" class="flex h-9 w-9 items-center justify-center rounded-xl bg-gray-100 text-gray-500 transition-all hover:bg-gray-200">
            <i class="fas fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Affiliator</h1>
            <p class="text-sm text-gray-500">Update {{ $affiliate->name }}.</p>
        </div>
    </div>

    @include('admin.affiliates.form', ['affiliate' => $affiliate, 'action' => route('admin.affiliates.update', $affiliate), 'method' => 'PUT'])
</div>
@endsection
