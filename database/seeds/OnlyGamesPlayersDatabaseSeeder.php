<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class OnlyGamesPlayersDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard();

		$this->call('GamesTableSeeder');
		$this->call('PlayersTableSeeder');
		$this->call('GamePointsTableSeeder');
	}

}
