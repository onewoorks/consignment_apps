<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kh_catalogs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('product_code');
            $table->string('branch_code');
            $table->integer('in_stock');
            $table->string('price_per_unit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kh_catalogs');
    }
}
