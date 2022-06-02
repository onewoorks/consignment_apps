<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kh_products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('product_code');
            $table->string('product_name');
            $table->string('description');
            $table->string('product_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kh_products');
    }
}
