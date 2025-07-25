@extends('vendor.layouts.layout')
@section('title', 'منتجاتي')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">منتجاتي</h1>
<p class="mb-4">هذه قائمة بجميع المنتجات الخاصة بك، يمكنك التعديل أو الحذف أو الإضافة من هنا.</p>

<!-- Tabs + زر الإضافة -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
<ul class="nav nav-tabs" id="product-tabs">
    @php
        $tabs = [
            null => 'الكل',
            'approved' => 'المعتمدة',
            'pending' => 'قيد الانتظار',
            'rejected' => 'المرفوضة',
            'archived' => 'الأرشيف'
        ];
    @endphp
    @foreach ($tabs as $key => $label)
        <li class="nav-item">
            <a href="{{ route('vendor.products.index', ['status' => $key]) }}"
               class="nav-link {{ request('status') === $key ? 'active' : '' }}"
               data-ajax="true"
               data-status="{{ $key }}">
               {{ $label }}
            </a>
        </li>
    @endforeach
</ul>

    <a href="{{ route('vendor.products.create') }}" class="btn btn-success">إضافة منتج جديد</a>
</div>

<div id="products-content">
    @include('vendor.dashboard.products.table')
</div>


@endsection

