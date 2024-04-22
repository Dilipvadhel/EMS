<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subcategory;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Subcategory::create([
            'category_id' => 1,
            'subcategory_name' => 'Fruits',
            'description' => 'Various fruits',

        ]);

        Subcategory::create([
            'category_id' => 2,
            'subcategory_name' => 'Vegetables',
            'description' => 'Different vegetables',
        ]);

        Subcategory::create([
            'category_id' => 3,
            'subcategory_name' => 'Black Tea',
            'description' => 'Black Tea variants',
        ]);

        Subcategory::create([
            'category_id' => 2,
            'subcategory_name' => 'Green Tea',
            'description' => 'Green Tea variants',
        ]);

        Subcategory::create([
            'category_id' => 3,
            'subcategory_name' => 'Smartphones',
            'description' => 'Various smartphones',
        ]);

        Subcategory::create([
            'category_id' => 3,
            'subcategory_name' => 'Laptops',
            'description' => 'Different laptops',
        ]);
    }
}
