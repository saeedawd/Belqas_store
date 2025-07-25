@extends('vendor.layouts.layout')
@section('title', 'منتجاتي')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">منتجاتي</h1>
<p class="mb-4">هذه قائمة بجميع المنتجات الخاصة بك، يمكنك التعديل أو الحذف أو الإضافة من هنا.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">قائمة المنتجات</h6>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('vendor.products.index') }}" class="btn btn-secondary mr-2 mb-2">عرض الكل</a>
            <a href="{{ route('vendor.products.index', ['status' => 'approved']) }}" class="btn btn-primary mr-2 mb-2">المعتمدة</a>
            <a href="{{ route('vendor.products.index', ['status' => 'pending']) }}" class="btn btn-warning mr-2 mb-2">قيد الانتظار</a>
            <a href="{{ route('vendor.products.index', ['status' => 'rejected']) }}" class="btn btn-danger mr-2 mb-2">المرفوضة</a>
            <a href="{{ route('vendor.products.index', ['status' => 'archived']) }}" class="btn btn-dark mr-2 mb-2">الأرشيف</a>
            <a href="{{ route('vendor.products.index', ['in_stock' => 0]) }}" class="btn btn-outline-danger mr-2 mb-2">غير متوفر</a>
            <a href="{{ route('vendor.products.create') }}" class="btn btn-success">إضافة منتج جديد</a>
        </div>
    </div>

    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>إسم المنتج</th>
                        <th>نوع المنتج</th>
                        <th>النوع الفرعي</th>
                        <th>الفئة</th>
                        <th>السعر</th>
                        <th>الوصف</th>
                        <th>الصورة</th>
                        <th>الحالة</th>
                        <th>تاريخ التعديل</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? '-' }}</td>
                            <td>{{ $product->subcategory->name ?? '-' }}</td>
                            <td>{{ $product->audience->name ?? '-' }}</td>
                            <td>{{ number_format($product->price, 2) }}</td>
                            <td>{{ Str::limit($product->description, 50) }}</td>
                            <td>
                                <div style="width: 50px; height: 50px; overflow: hidden; border-radius: 5px; margin: auto;">
                                    <img src="{{ asset('storage/' . $product->image) }}" width="100%" height="100%" style="object-fit: cover;" alt="صورة المنتج">
                                </div>
                            </td>       
                            <td>
                                @php
                                    $status = $product->status;
                                    $colors = [
                                        'approved' => 'success',
                                        'pending' => 'warning',
                                        'rejected' => 'danger',
                                        'archived' => 'secondary',
                                    ];
                                    $labels = [
                                        'approved' => 'معتمد',
                                        'pending' => 'قيد الانتظار',
                                        'rejected' => 'مرفوض',
                                        'archived' => 'مؤرشف',
                                    ];
                                @endphp

                                <span class="badge badge-{{ $colors[$status] ?? 'light' }}">
                                    {{ $labels[$status] ?? 'غير معروف' }}
                                </span>
                            </td>
                     
                            <td>{{ $product->updated_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('vendor.products.show', $product->id) }}" class="btn btn-info btn-sm mb-1">عرض</a>
                                <a href="{{ route('vendor.products.edit', $product->id) }}" class="btn btn-warning btn-sm mb-1">تعديل</a>
                            <form action="{{ route('vendor.products.destroy', $product->id) }}" method="POST" class="d-inline-block form-delete-product">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm mb-1 btn-delete-product">حذف</button>
                            </form>


                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="10" class="text-center">لا توجد منتجات</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
 