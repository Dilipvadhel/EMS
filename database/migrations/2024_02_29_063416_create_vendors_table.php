<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_name');
            $table->string('company_name');
            $table->string('mobile_no');
            $table->string('address');
            $table->string('email');
            $table->decimal('balance', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations. 
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
