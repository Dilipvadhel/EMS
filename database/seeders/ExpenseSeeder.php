<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Vendor;



class ExpenseSeeder extends Seeder
{
    public function run()
    {
        Expense::create([
            'category_id' => 1,
            'subcategory_id' => 1,
            'vendor_id' => 1,
            'amount' => 0.00,
            'date' => '2024-03-11',
        ]);
    }
}
