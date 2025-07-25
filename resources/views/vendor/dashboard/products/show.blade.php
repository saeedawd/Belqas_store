@extends('vendor.layouts.layout')

@section('title', 'تفاصيل المنتج')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border rounded mb-4">
                <div class="card-header bg-primary text-white text-center">
                    <h2 class="mb-0">تفاصيل المنتج</h2>
                </div>
                <div class="card-body bg-white">
                    <div class="row mb-4 justify-content-center">
                        <div class="col-md-4 text-center">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="صورة المنتج" 
                                     class="img-fluid rounded border" 
                                     style="max-height: 250px; object-fit: contain;">
                            @else
                                <p class="text-muted fst-italic">لا توجد صورة رئيسية</p>
                            @endif
                        </div>
                    </div>

                    <table class="table table-bordered table-hover shadow-sm">
                        <tbody>
                            <tr><th class="bg-light text-nowrap" style="width: 180px;">اسم المنتج</th><td>{{ $product->name }}</td></tr>
                            <tr><th class="bg-light text-nowrap">السعر</th><td>{{ number_format($product->price, 2) }} ج.م</td></tr>
                            <tr><th class="bg-light text-nowrap">سعر الخصم</th><td>{{ $product->sale_price ? number_format($product->sale_price, 2) : '-' }}</td></tr>
                            <tr><th class="bg-light text-nowrap align-top">الوصف</th><td style="white-space: pre-wrap;">{{ $product->description }}</td></tr>
                            <tr><th class="bg-light text-nowrap">الباركود</th><td>{{ $product->barcode ?? '-' }}</td></tr>
                            <tr><th class="bg-light text-nowrap">عدد المشاهدات</th><td>{{ $product->views }}</td></tr>
                            <tr><th class="bg-light text-nowrap">مميز؟</th><td>{{ $product->is_featured ? 'نعم' : 'لا' }}</td></tr>
                            <tr><th class="bg-light text-nowrap">الحالة</th><td>{{ ucfirst($product->status) }}</td></tr>
                            <tr><th class="bg-light text-nowrap">المخزون</th><td>{{ $product->stock }}</td></tr>
                            <tr><th class="bg-light text-nowrap">اللون</th><td>{{ $product->color->name ?? '-' }}</td></tr>
                            <tr><th class="bg-light text-nowrap">المقاس</th><td>{{ $product->size->name ?? '-' }}</td></tr>
                            <tr><th class="bg-light text-nowrap">الفئة</th><td>{{ $product->category->name ?? '-' }}</td></tr>
                            <tr><th class="bg-light text-nowrap">الفئة الفرعية</th><td>{{ $product->subcategory->name ?? '-' }}</td></tr>
                            <tr><th class="bg-light text-nowrap">الجمهور المستهدف</th><td>{{ $product->audience->name ?? '-' }}</td></tr>
                            <tr><th class="bg-light text-nowrap">Slug</th><td>{{ $product->slug }}</td></tr>
                            <tr><th class="bg-light text-nowrap">مؤرشف</th><td>{{ $product->is_archived ? 'نعم' : 'لا' }}</td></tr>
                            <tr><th class="bg-light text-nowrap">تاريخ الإضافة</th><td>{{ $product->created_at->format('Y-m-d H:i') }}</td></tr>
                            <tr><th class="bg-light text-nowrap">آخر تعديل</th><td>{{ $product->updated_at->format('Y-m-d H:i') }}</td></tr>
                        </tbody>
                    </table>

                    <h5 class="mb-3 text-primary border-bottom pb-2">الصور الإضافية</h5>
                    <div class="row g-3">
                        @if ($product->images && $product->images->count())
                            @foreach ($product->images as $img)
                                <div class="col-6 col-sm-4 col-md-3">
                                    <img src="{{ asset('storage/' . $img->image) }}" 
                                         alt="صورة إضافية" 
                                         class="img-thumbnail w-100 rounded"
                                         style="height: 160px; object-fit: cover;">
                                </div>
                            @endforeach
                        @else
                            <div class="col">
                                <p class="text-muted fst-italic">لا توجد صور إضافية</p>
                            </div>
                        @endif
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('vendor.products.index') }}" class="btn btn-outline-primary px-5">رجوع</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 