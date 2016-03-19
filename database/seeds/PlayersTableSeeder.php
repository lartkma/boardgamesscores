<?php

use Illuminate\Database\Seeder;

class PlayersTableSeeder extends Seeder {

    public function run(){
        DB::table('players')->insert([
            ['name'=>'Oscar Eduardo', 'bga_nick'=>'dagabian'],
            ['name'=>'Luis Malca', 'bga_nick'=>'Riker'],
            ['name'=>'Miguel Carrillo', 'bga_nick'=>'Doriard'],
        ]);
    }

}
