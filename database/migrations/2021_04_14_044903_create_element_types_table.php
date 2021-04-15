<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('element_types', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->index()->unique();
            $table->integer('element_count');
            $table->string('plural_name', 16);
            $table->string('plural_name_short', 8);
            $table->integer('squad_max_play');
            $table->integer('squad_min_play');
            $table->integer('squad_select');
            $table->boolean('ui_shirt_specific');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('element_types');
    }
}
