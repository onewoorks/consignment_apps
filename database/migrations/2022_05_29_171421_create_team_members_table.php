<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kh_team_members', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('team_id');
            $table->string('user_id');
            $table->string('name');
            $table->date('date_joined');
            $table->string('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kh_team_members');
    }
}
