<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kh_task_assignments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('task_id');
            $table->integer('sequence');
            $table->string('status');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->integer('shop_id');
            $table->string('shop_status');
            $table->string('shop_image');
            $table->string('remarks');
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
        Schema::dropIfExists('kh_task_assignments');
    }
}
