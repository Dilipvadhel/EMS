<?php

namespace Database\Seeders;

use Database\Seeders\CategorySeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\VendorSeeder;
use Database\Seeders\SubcategorySeeder;
use Database\Seeders\ExpenseSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PaymentSeeder;





use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            VendorSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ExpenseSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
