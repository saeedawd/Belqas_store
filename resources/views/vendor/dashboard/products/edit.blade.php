@extends('vendor.layouts.layout')

@section('title', 'تعديل المنتج')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-primary">تعديل المنتج</h1>

    <form action="{{ route('vendor.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="border p-4 rounded shadow-sm bg-white">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>اسم المنتج</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="form-group">
            <label>الوصف</label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>السعر</label>
                <input type="number" name="price" class="form-control" step="0.01" value="{{ old('price', $product->price) }}" required>
            </div>
            <div class="form-group col-md-6">
                <label>السعر بعد الخصم</label>
                <input type="number" name="sale_price" class="form-control" step="0.01" value="{{ old('sale_price', $product->sale_price) }}">
            </div>
        </div>

        <div class="form-group">
            <label>الفئة</label>
            <select name="category_id" class="form-control" id="categorySelect" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
                <option value="add_new">إضافة فئة جديدة</option>
            </select>
            <input type="text" name="new_category" id="newCategoryInput" class="form-control mt-2" placeholder="اكتب اسم الفئة الجديدة" style="display: none;">
        </div>

        <div class="form-group">
            <label>الفئة الفرعية</label>
            <select name="subcategory_id" class="form-control" id="subcategorySelect" required>
                @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" {{ $subcategory->id == $product->subcategory_id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                @endforeach
                <option value="add_new">إضافة فئة فرعية جديدة</option>
            </select>
            <input type="text" name="new_subcategory" id="newSubcategoryInput" class="form-control mt-2" placeholder="اكتب اسم الفئة الفرعية الجديدة" style="display: none;">
        </div>

        <div class="form-group">
            <label>الجمهور المستهدف</label><br>
            @foreach($audiences as $audience)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="audience_id" value="{{ $audience->id }}" {{ $audience->id == $product->audience_id ? 'checked' : '' }} required>
                    <label class="form-check-label">{{ $audience->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label>الصورة الرئيسية</label>
            <input type="file" name="image" class="form-control">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="100" class="mt-2 img-thumbnail">
            @endif
        </div>

        <div class="form-group">
            <label>صور فرعية جديدة (يمكن اختيار أكثر من صورة)</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>اللون</label>
                <select name="color_id" id="colorSelect" class="form-control">
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}" {{ $color->id == $product->color_id ? 'selected' : '' }}>{{ $color->name }}</option>
                    @endforeach
                    <option value="add_new">إضافة لون جديد</option>
                </select>
                <input type="text" name="new_color" id="newColorInput" class="form-control mt-2" style="display: none;" placeholder="أدخل لونًا جديدًا">
            </div>

            <div class="form-group col-md-6">
                <label>المقاس</label>
                <select name="size_id" id="sizeSelect" class="form-control">
                    @foreach ($sizes as $size)
                        <option value="{{ $size->id }}" {{ $size->id == $product->size_id ? 'selected' : '' }}>{{ $size->name }}</option>
                    @endforeach
                    <option value="add_new">إضافة مقاس جديد</option>
                </select>
                <input type="text" name="new_size" id="newSizeInput" class="form-control mt-2" style="display: none;" placeholder="أدخل مقاسًا جديدًا">
            </div>
        </div>

        <div class="form-group">
            <label>العدد في المخزن</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}">
        </div>

        <div class="form-check mb-2">
            <input type="checkbox" name="is_archived" class="form-check-input" id="is_archived" {{ $product->is_archived ? 'checked' : '' }}>
            <label for="is_archived" class="form-check-label">أرشفة المنتج</label>
        </div>

        <div class="form-check mb-4">
            <input type="checkbox" name="in_stock" class="form-check-input" id="in_stock" {{ $product->in_stock ? 'checked' : '' }}>
            <label for="in_stock" class="form-check-label">متوفر في المخزون</label>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success px-4">تحديث المنتج</button>
        </div>
    </form>
</div>
@endsection
 