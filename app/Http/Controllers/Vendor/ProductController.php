<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Audience;
use App\Models\ProductImage;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('status')) {
            switch ($request->status) {
                case 'archived':
                    $query->where('is_archived', true);
                    break;
                case 'approved':
                    $query->where('status', 'approved');
                    break;
                case 'pending':
                    $query->where('status', 'pending');
                    break;
                case 'rejected':
                    $query->where('status', 'rejected');
                    break;
                case 'out-of-stock':
                    $query->where('in_stock', false);
                    break;
            }
        } elseif ($request->has('in_stock') && $request->in_stock == 0) {
            $query->where('in_stock', false);
        } else {
            $query->where('is_archived', false)
                ->where('status', '!=', 'rejected');
        }

        $products = $query->latest()->get();

        // ✅ لو الطلب جاي من AJAX رجّع جدول المنتجات فقط
        if ($request->ajax()) {
            return view('vendor.dashboard.products.table', compact('products'));
        }

        // ✅ لو الطلب عادي رجّع الصفحة كاملة
        return view('vendor.dashboard.products.index', compact('products'));
    }


    public function create()
    {
        return view('vendor.dashboard.products.create', [
            'categories' => Category::all(),
            'subcategories' => Subcategory::all(),
            'audiences' => Audience::all(),
            'colors' => Color::all(),
            'sizes' => Size::all(),
        ]);
    }

    public function store(Request $request)
    {
        $manager = new ImageManager(new Driver());

        if ($request->category_id === 'add_new' && $request->filled('new_category')) {
            $category = Category::firstOrCreate(['name' => trim($request->new_category)]);
            $request->merge(['category_id' => $category->id]);
        }

        if ($request->subcategory_id === 'add_new' && $request->filled('new_subcategory')) {
            $subcategory = Subcategory::firstOrCreate([
                'name' => trim($request->new_subcategory),
                'category_id' => $request->category_id,
            ]);
            $request->merge(['subcategory_id' => $subcategory->id]);
        }

        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'stock' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'audience_id' => 'required|exists:audiences,id',
            'image' => 'nullable|image',
            'images.*' => 'nullable|image',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['color_id'] = $request->color_id === 'add_new' && $request->filled('new_color')
            ? Color::firstOrCreate(['name' => trim($request->new_color)])->id
            : $request->color_id;

        $validated['size_id'] = $request->size_id === 'add_new' && $request->filled('new_size')
            ? Size::firstOrCreate(['name' => trim($request->new_size)])->id
            : $request->size_id;

        $validated['vendor_id'] = Auth::user()->vendor->id;
        $validated['status'] = 'pending';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = uniqid() . '.webp';
            $path = public_path('storage/products/' . $filename);

            $img = $manager->read($image->getPathname())
                        ->cover(800, 800)
                        ->toWebp(85)
                        ->save($path);

            $validated['image'] = 'products/' . $filename;
        }

        $product = Product::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $filename = uniqid() . '.webp';
                $path = public_path('storage/products/' . $filename);

                $img = $manager->read($imageFile->getPathname())
                            ->cover(800, 800)
                            ->toWebp(85)
                            ->save($path);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'products/' . $filename,
                ]);
            }
        }


        return redirect()->route('vendor.products.index')->with('success', 'تم إضافة المنتج');
    }

    public function show($id)
    {
        $product = Product::with(['category', 'subcategory', 'audience', 'images'])
            ->where('vendor_id', Auth::user()->vendor->id)
            ->findOrFail($id);

        return view('vendor.dashboard.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::where('vendor_id', Auth::user()->vendor->id)->findOrFail($id);

        return view('vendor.dashboard.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'subcategories' => Subcategory::all(),
            'audiences' => Audience::all(),
            'colors' => Color::all(),
            'sizes' => Size::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $manager = new ImageManager(new Driver());
        $product = Product::where('vendor_id', Auth::user()->vendor->id)->findOrFail($id);

        if ($request->category_id === 'add_new' && $request->filled('new_category')) {
            $category = Category::firstOrCreate(['name' => trim($request->new_category)]);
            $request->merge(['category_id' => $category->id]);
        }

        if ($request->subcategory_id === 'add_new' && $request->filled('new_subcategory')) {
            $subcategory = Subcategory::firstOrCreate([
                'name' => trim($request->new_subcategory),
                'category_id' => $request->category_id
            ]);
            $request->merge(['subcategory_id' => $subcategory->id]);
        }

        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'stock' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'audience_id' => 'required|exists:audiences,id',
            'image' => 'nullable|image',
            'images.*' => 'nullable|image',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['color_id'] = $request->color_id === 'add_new' && $request->filled('new_color')
            ? Color::firstOrCreate(['name' => trim($request->new_color)])->id
            : $request->color_id;

        $validated['size_id'] = $request->size_id === 'add_new' && $request->filled('new_size')
            ? Size::firstOrCreate(['name' => trim($request->new_size)])->id
            : $request->size_id;

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path('storage/' . $product->image))) {
                unlink(public_path('storage/' . $product->image));
            }

            $image = $request->file('image');
            $filename = uniqid() . '.webp';
            $path = public_path('storage/products/' . $filename);

            $img = $manager->read($image->getPathname())
                        ->cover(800, 800)
                        ->toWebp()
                        ->save($path, 85);

            $validated['image'] = 'products/' . $filename;
        }

        // حذف الصور القديمة
        foreach ($product->images as $img) {
            if (file_exists(public_path('storage/' . $img->image))) {
                unlink(public_path('storage/' . $img->image));
            }
            $img->delete();
        }

        // صور متعددة جديدة
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $filename = uniqid() . '.webp';
                $path = public_path('storage/products/' . $filename);

                $img = $manager->read($imageFile->getPathname())
                            ->cover(800, 800)
                            ->toWebp()
                            ->save($path, 85);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'products/' . $filename,
                ]);
            }
        }


        $validated['is_archived'] = $request->has('is_archived');
        $validated['in_stock'] = $request->has('in_stock');

        $product->update($validated);

        return redirect()->route('vendor.products.index')->with('success', 'تم تعديل المنتج');
    }

        public function destroy($id)
        {
            $product = Product::where('vendor_id', Auth::user()->vendor->id)->findOrFail($id);
            $product->is_archived = true;
            $product->save();

            return redirect()->route('vendor.products.index')->with('success', 'تم نقل المنتج إلى الأرشيف.');
        }

        public function restore($id)
        {
            $product = Product::where('vendor_id', Auth::user()->vendor->id)->findOrFail($id);
            $product->is_archived = false;

            $product->status = 'pending';

            $product->save();

            return redirect()->route('vendor.products.index')->with('success', 'تمت استعادة المنتج بنجاح.');
        }

        public function forceDelete($id)
        {
            $product = Product::where('vendor_id', Auth::user()->vendor->id)->findOrFail($id);

            // حذف الصور الخاصة بالمنتج إن وجدت
            foreach ($product->images as $image) {
                if (file_exists(public_path('storage/' . $image->image))) {
                    unlink(public_path('storage/' . $image->image));
                }
                $image->delete();
            }

            // حذف صورة واحدة للمنتج
            if ($product->image && file_exists(public_path('storage/' . $product->image))) {
                unlink(public_path('storage/' . $product->image));
            }

            $product->delete();

            return redirect()->route('vendor.products.index')->with('success', 'تم حذف المنتج نهائيًا.');
        }




}