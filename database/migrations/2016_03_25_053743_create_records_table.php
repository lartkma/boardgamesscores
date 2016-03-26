<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('match_player_score_records', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('game_id')->unsigned();
            $table->foreign('game_id')->references('id')->on('games');
            $table->smallInteger('number_players')->unsigned();
            $table->integer('match_player_score_id')->unsigned();
            $table->foreign('match_player_score_id')->references('id')->on('match_player_scores');
            $table->smallInteger('point_order');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('match_player_score_records');
	}

}
