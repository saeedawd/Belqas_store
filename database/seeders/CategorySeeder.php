<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'ملابس', 'slug' => 'clothing'],
            ['name' => 'إكسسوارات', 'slug' => 'accessories'],
            ['name' => 'أحذية', 'slug' => 'shoes'],
            ['name' => 'منتجات تجميل', 'slug' => 'beauty'],
            ['name' => 'رياضة ولياقة', 'slug' => 'sports'],
            ['name' => 'ألعاب أطفال', 'slug' => 'toys'],
            ['name' => 'ساعات', 'slug' => 'watches'],
            ['name' => 'نظارات', 'slug' => 'glasses'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
