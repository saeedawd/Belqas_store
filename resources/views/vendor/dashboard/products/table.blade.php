<!-- جدول المنتجات -->
<div class="card shadow mb-4" >
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>اسم المنتج</th>
                        <th>الفئة</th>
                        <th>النوع الفرعي</th>
                        <th>الصورة</th>
                        <th>السعر</th>
                        <th>السعر بعد الخصم</th>
                        <th>آخر تعديل</th>
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
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="صورة المنتج" class="product-img">
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ number_format($product->price, 2) }}</td>
                            <td>{{ number_format($product->Sale_price, 2) }}</td>
                            <td>{{ $product->updated_at->format('Y-m-d') }}</td>
                            <td>
                                @if($product->is_archived)
                                    {{-- زر استرجاع --}}
                                    <form action="{{ route('vendor.products.restore', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل تريد استرجاع المنتج؟')">
                                        @csrf
                                        <button class="btn btn-sm btn-primary" title="استرجاع">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </form>

                                    {{-- زر حذف نهائي --}}
                                    <form action="{{ route('vendor.products.forceDelete', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('سيتم حذف المنتج نهائيًا، هل أنت متأكد؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="حذف نهائي">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    {{-- الإجراءات العادية --}}
                                    <a href="{{ route('vendor.products.show', $product->id) }}" class="btn btn-sm btn-info" title="عرض" data-ajax="true">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('vendor.products.edit', $product->id) }}" class="btn btn-sm btn-warning" title="تعديل" data-ajax="true">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('vendor.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="أرشفة">
                                            <i class="fas fa-archive"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr><td colspan="9" class="text-center">لا توجد منتجات</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>