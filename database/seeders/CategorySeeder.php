<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 =  Category::create([
            'name' => 'Food',
            'description' => 'This is good for Body',
        ]);

        Subcategory::create([
            'category_id' => $category1->id,
            'name' => 'Apple',
        ]);


        $category2 = Category::create([
            'name' => 'Education',
            'description' => 'Important in Life',
        ]);

        Subcategory::create([
            'category_id' => $category2->id,
            'name' => 'MCA',
        ]);
    }
}
