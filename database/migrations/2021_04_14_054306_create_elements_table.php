<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->index()->unique();
            $table->integer('assists')->default(0);
            $table->integer('bonus')->default(0);
            $table->integer('bps')->default(0);
            $table->integer('clean_sheets');
            $table->integer('code');
            $table->string('creativity', 100);
            $table->integer('creativity_rank');
            $table->integer('creativity_rank_type');
            $table->foreignId('element_type')->constrained('element_types')->cascadeOnDelete();
            $table->integer('event_points');
            $table->string('first_name');
            $table->string('form', 100);
            $table->integer('goals_conceded');
            $table->integer('goals_scored');
            $table->string('ict_index', 100);
            $table->integer('ict_index_rank');
            $table->integer('ict_index_rank_type');
            $table->string('influence', 100);
            $table->integer('influence_rank');
            $table->integer('influence_rank_type');
            $table->integer('minutes');
            $table->integer('red_cards')->default(0);
            $table->string('second_name', 100);
            $table->foreignId('team')->constrained('teams')->cascadeOnDelete();
            $table->integer('team_code');
            $table->string('threat');
            $table->integer('threat_rank');
            $table->integer('threat_rank_type');
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
        Schema::dropIfExists('elements');
    }
}
