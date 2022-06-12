<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kh_inventories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('shop_id');
            $table->string('region');
            $table->string('product_code');
            $table->string('product_name');
            $table->string('stock_flow');
            $table->integer('quantity');
            $table->float('price_per_unit');
            $table->float('total_price');
            $table->string('updated_by');
            $table->string('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kh_inventories');
    }
}
