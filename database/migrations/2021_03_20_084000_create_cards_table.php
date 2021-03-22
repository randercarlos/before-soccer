<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['Y', 'R']);
            $table->unsignedInteger('match_id');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('player_id');

            $table->foreign('match_id')->references('id')->on('matches')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('team_id')->references('id')->on('teams')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('player_id')->references('id')->on('players')
                ->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('cards');
    }
}
