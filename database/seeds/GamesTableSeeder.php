<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder {

    public function run(){
        DB::table('games')->insert([
            ['name'=>'Carcassonne', 'bgg_id'=>822, 'min_players'=>2, 'max_players'=>5],
            ['name'=>'Power Grid', 'bgg_id'=>2651, 'min_players'=>2, 'max_players'=>6],
            ['name'=>'No Thanks!', 'bgg_id'=>12942, 'min_players'=>3, 'max_players'=>5],
        ]);
    }

}
