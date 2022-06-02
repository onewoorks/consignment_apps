<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kh_tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('task_name');
            $table->integer('team_id');
            $table->string('task_status');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->string('remarks');
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
        Schema::dropIfExists('kh_tasks');
    }
}
