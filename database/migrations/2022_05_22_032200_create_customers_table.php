<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kh_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('shop_name');
            $table->string('region');
            $table->string('address');
            $table->string('owner');
            $table->string('phone_number');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('shop_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kh_customers');
    }
}
