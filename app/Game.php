<?php namespace BoardGameScores;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {

    public $timestamps = false;

    public function game_points(){
        return $this->hasMany('BoardGameScores\GamePoint');
    }

}
