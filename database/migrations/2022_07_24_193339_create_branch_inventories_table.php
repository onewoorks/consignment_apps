<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kh_branch_inventories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('branch_code');
            $table->string('product_code');
            $table->integer('quantity');
            $table->decimal('total_price', $precision = 18, $scale = 2);
            $table->decimal('price_per_unit', $precision = 18, $scale = 2);
            $table->string('created_by');
            $table->string('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kh_branch_inventories');
    }
}
