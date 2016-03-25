<?php

use Illuminate\Database\Seeder;

class MatchPlayerScorePointsTableSeeder extends Seeder {

    public function run(){
        DB::table('match_player_score_points')->insert([
            ['match_player_score_id'=>1, 'game_point_id'=>1, 'value'=>50],
            ['match_player_score_id'=>2, 'game_point_id'=>1, 'value'=>62],
            ['match_player_score_id'=>3, 'game_point_id'=>1, 'value'=>54],
            ['match_player_score_id'=>4, 'game_point_id'=>1, 'value'=>65],
            ['match_player_score_id'=>5, 'game_point_id'=>1, 'value'=>61],
            ['match_player_score_id'=>6, 'game_point_id'=>2, 'value'=>15],
            ['match_player_score_id'=>6, 'game_point_id'=>3, 'value'=>90],
            ['match_player_score_id'=>7, 'game_point_id'=>2, 'value'=>14],
            ['match_player_score_id'=>7, 'game_point_id'=>3, 'value'=>110],
            ['match_player_score_id'=>7, 'game_point_id'=>4, 'value'=>16],
            ['match_player_score_id'=>8, 'game_point_id'=>2, 'value'=>15],
            ['match_player_score_id'=>8, 'game_point_id'=>3, 'value'=>40],
            ['match_player_score_id'=>8, 'game_point_id'=>4, 'value'=>15],
            ['match_player_score_id'=>9, 'game_point_id'=>2, 'value'=>15],
            ['match_player_score_id'=>9, 'game_point_id'=>3, 'value'=>90],
            ['match_player_score_id'=>9, 'game_point_id'=>4, 'value'=>15],
            ['match_player_score_id'=>10, 'game_point_id'=>5, 'value'=>25],
            ['match_player_score_id'=>11, 'game_point_id'=>5, 'value'=>14],
            ['match_player_score_id'=>12, 'game_point_id'=>5, 'value'=>10],
        ]);
    }

}
