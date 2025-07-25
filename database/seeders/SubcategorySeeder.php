<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    public function run(): void
    {
        $subcategories = [
            'ملابس' => ['تيشيرتات', 'قمصان', 'بناطيل', 'جاكيتات', 'فساتين'],
            'أحذية' => ['أحذية رياضية', 'أحذية جلد', 'صنادل', 'بوتات'],
            'إكسسوارات' => ['ساعات', 'نظارات', 'حقائب', 'أساور', 'قبعات'],
        ];

        foreach ($subcategories as $categoryName => $subs) {
            $category = Category::where('name', $categoryName)->first();

            if (!$category) {
                $category = Category::create([
                    'name' => $categoryName,
                    'slug' => Str::slug($categoryName),
                ]);
            }

            foreach ($subs as $sub) {
                Subcategory::updateOrCreate([
                    'name' => $sub,
                    'category_id' => $category->id,
                ], [
                    'slug' => Str::slug($sub),
                ]);
            }
        }
    }
}
