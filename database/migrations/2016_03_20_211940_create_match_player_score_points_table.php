<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchPlayerScorePointsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('match_player_score_points', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('match_player_score_id')->unsigned();
            $table->foreign('match_player_score_id')->references('id')->on('match_player_scores')->
                onDelete('cascade');
            $table->integer('game_point_id')->unsigned();
            $table->foreign('game_point_id')->references('id')->on('game_points');
            $table->decimal('value', 9, 1);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('match_player_score_points');
	}

}
