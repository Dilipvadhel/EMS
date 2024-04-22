<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendor::create([
            'vendor_name' => 'test',
            'company_name' => 'Oneman',
            'mobile_no' => '1234567890',
            'address' => 'Periyar Nagar',
            'email' => 'test@gmail.com',
        ]);
        Vendor::create([
            'vendor_name' => 'Teaman',
            'company_name' => 'Tcs',
            'mobile_no' => '1234567890',
            'address' => 'banglore',
            'email' => 'tcs@gmail.com',
        ]);

        Vendor::create([
            'vendor_name' => 'CleanMan',
            'company_name' => 'Teccel',
            'mobile_no' => '1234567890',
            'address' => 'Ahemdabad',
            'email' => 'teccel@gmail.com',
        ]);
    }
}
