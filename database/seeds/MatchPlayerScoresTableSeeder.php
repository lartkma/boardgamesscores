<?php

use Illuminate\Database\Seeder;

class MatchPlayerScoresTableSeeder extends Seeder {

    public function run(){
        DB::table('match_player_scores')->insert([
            ['game_id'=>1,'player_id'=>1,'number_players'=>4, 'created_at'=>time(), 'updated_at'=>time()],
            ['game_id'=>1,'player_id'=>2,'number_players'=>4, 'created_at'=>time(), 'updated_at'=>time()],
            ['game_id'=>1,'player_id'=>2,'number_players'=>4, 'created_at'=>time(), 'updated_at'=>time()],
            ['game_id'=>1,'player_id'=>1,'number_players'=>5, 'created_at'=>time(), 'updated_at'=>time()],
            ['game_id'=>1,'player_id'=>3,'number_players'=>5, 'created_at'=>time(), 'updated_at'=>time()],
            ['game_id'=>2,'player_id'=>1,'number_players'=>5, 'created_at'=>time(), 'updated_at'=>time()],
            ['game_id'=>2,'player_id'=>2,'number_players'=>5, 'created_at'=>time(), 'updated_at'=>time()],
            ['game_id'=>2,'player_id'=>3,'number_players'=>5, 'created_at'=>time(), 'updated_at'=>time()],
            ['game_id'=>2,'player_id'=>1,'number_players'=>5, 'created_at'=>time(), 'updated_at'=>time()],
            ['game_id'=>3,'player_id'=>1,'number_players'=>4, 'created_at'=>time(), 'updated_at'=>time()],
            ['game_id'=>3,'player_id'=>1,'number_players'=>4, 'created_at'=>time(), 'updated_at'=>time()],
            ['game_id'=>3,'player_id'=>2,'number_players'=>4, 'created_at'=>time(), 'updated_at'=>time()],
        ]);
    }

}
