<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->decimal('amount', 8, 2);
            $table->date('date')->format('d/m/y');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
            $table->foreign('vendor_id')->references('id')->on('vendors');
        });
    }

    public function down()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
        });
        Schema::dropIfExists('expenses');
    }
}
