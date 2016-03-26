<?php

use Illuminate\Database\Seeder;

class MatchPlayerScoreRecordsTableSeeder extends Seeder {

    public function run(){
        DB::table('match_player_score_records')->insert([
            ['game_id'=>1, 'number_players'=>4, 'match_player_score_id'=>2, 'point_order'=>1],
            ['game_id'=>1, 'number_players'=>5, 'match_player_score_id'=>4, 'point_order'=>1],
            ['game_id'=>2, 'number_players'=>5, 'match_player_score_id'=>9, 'point_order'=>2],
            ['game_id'=>3, 'number_players'=>4, 'match_player_score_id'=>12, 'point_order'=>1],
        ]);
    }

}
