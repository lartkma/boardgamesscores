<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('games', function(Blueprint $table) {
			$table->increments('id');
            $table->string('name');
            $table->integer('bgg_id');
            $table->smallInteger('min_players');
            $table->smallInteger('max_players');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('games');
	}

}
