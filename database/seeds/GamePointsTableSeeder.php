<?php

use Illuminate\Database\Seeder;

class GamePointsTableSeeder extends Seeder {

    public function run(){
        DB::table('game_points')->insert([
            ['game_id'=>1, 'label'=>'Points', 'order'=>1, 'is_negative'=>false],
            ['game_id'=>2, 'label'=>'Supplied cities', 'order'=>1, 'is_negative'=>false],
            ['game_id'=>2, 'label'=>'Cash', 'order'=>2, 'is_negative'=>false],
            ['game_id'=>2, 'label'=>'Cities', 'order'=>3, 'is_negative'=>false],
            ['game_id'=>3, 'label'=>'Points', 'order'=>1, 'is_negative'=>true],
        ]);
    }

}
