<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLovsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kh_lovs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('lov_category');
            $table->string('lov_code');
            $table->string('lov_name');
            $table->string('description');
            $table->string('is_default');
            $table->string('is_required');
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
        Schema::dropIfExists('kh_lovs');
    }
}
