<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->index()->unique();
            $table->integer('code');
            $table->string('name');
            $table->string('short_name');
            $table->integer('strength');
            $table->integer('strength_attack_away');
            $table->integer('strength_attack_home');
            $table->integer('strength_defence_away');
            $table->integer('strength_defence_home');
            $table->integer('strength_overall_away');
            $table->integer('strength_overall_home');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
