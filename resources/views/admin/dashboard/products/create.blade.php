@extends('vendor.layouts.layout')

@section('title', 'إضافة منتج جديد')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center text-primary">إضافة منتج جديد</h1>

    <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data" class="border p-4 rounded shadow-sm bg-white">
        @csrf

        <div class="form-group">
            <label>اسم المنتج</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>الوصف</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>السعر</label>
                <input type="number" name="price" class="form-control" step="0.01" required>
            </div>
            <div class="form-group col-md-6">
                <label>السعر بعد الخصم</label>
                <input type="number" name="sale_price" class="form-control" step="0.01">
            </div>
        </div>
 
        {{-- الفئة --}}
        <div class="form-group">
            <label>الفئة</label>
            <select name="category_id" class="form-control" id="categorySelect" required>
                <option value="">اختر فئة</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
                <option value="add_new">إضافة فئة جديدة</option>
            </select>
            <input type="text" name="new_category" id="newCategoryInput" class="form-control mt-2" placeholder="اكتب اسم الفئة الجديدة" style="display:none;">
        </div>

        {{-- الفئة الفرعية --}}
        <div class="form-group">
            <label>الفئة الفرعية</label>
            <select name="subcategory_id" class="form-control" id="subcategorySelect" required>
                <option value="">اختر فئة فرعية</option>
                @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
                <option value="add_new">إضافة فئة فرعية جديدة</option>
            </select>
            <input type="text" name="new_subcategory" id="newSubcategoryInput" class="form-control mt-2" placeholder="اكتب اسم الفئة الفرعية الجديدة" style="display:none;">
        </div>

        {{-- الجمهور المستهدف --}}
        <div class="form-group">
            <label>الجمهور المستهدف</label><br>
            @foreach($audiences as $audience)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="audience_id" value="{{ $audience->id }}" required>
                    <label class="form-check-label">{{ $audience->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label>الصورة الرئيسية</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group">
            <label>صور فرعية (يمكن اختيار أكثر من صورة)</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <div class="form-row">
            <!-- اللون -->
            <div class="form-group col-md-6">
                <label>اللون</label>
                <select name="color_id" id="colorSelect" class="form-control">
                    <option value="">اختر لونًا</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                    <option value="add_new">إضافة لون جديد</option>
                </select>
                <input type="text" name="new_color" id="newColorInput" class="form-control mt-2" style="display: none;" placeholder="أدخل لونًا جديدًا">
            </div>

            <!-- المقاس -->
            <div class="form-group col-md-6">
                <label>المقاس</label>
                <select name="size_id" id="sizeSelect" class="form-control">
                    <option value="">اختر مقاسًا</option>
                    @foreach ($sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                    @endforeach
                    <option value="add_new">إضافة مقاس جديد</option>
                </select>
                <input type="text" name="new_size" id="newSizeInput" class="form-control mt-2" style="display: none;" placeholder="أدخل مقاسًا جديدًا">
            </div>
        </div>

        <div class="form-group">
            <label>العدد في المخزن</label>
            <input type="number" name="stock" class="form-control">
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success px-4">حفظ المنتج</button>
        </div>
    </form>
</div>
@endsection
