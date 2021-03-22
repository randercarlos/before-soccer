<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedInteger('home_team_id');
            $table->unsignedInteger('visitor_team_id');
            $table->enum('home_team_score', ['W','L', 'T']);
            $table->enum('visitor_team_score', ['W','L', 'T']);

            $table->foreign('home_team_id')->references('id')->on('teams')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('visitor_team_id')->references('id')->on('teams')
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
        Schema::dropIfExists('matches');
    }
}
