<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\Audience;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $subcategories = Subcategory::all();

        foreach ($subcategories as $subcategory) {
            // نضيف لكل فئة فرعية 10 منتجات
            for ($i = 0; $i < 10; $i++) {
                $name = $faker->unique()->words(2, true);

                Product::create([
                    'subcategory_id' => $subcategory->id,
                    'category_id' => $subcategory->category_id,
                    'audience_id' => rand(1, 3),
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => $faker->paragraph,
                    'price' => $faker->randomFloat(2, 50, 1000),
                    'status' => $faker->randomElement(['pending', 'approved', 'rejected']),
                    'stock' => $faker->numberBetween(0, 100),
                    'vendor_id' => 1, 
                ]);
            }
        }
    }
}
