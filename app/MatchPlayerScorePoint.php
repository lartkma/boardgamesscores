<?php namespace BoardGameScores;

use Illuminate\Database\Eloquent\Model;

class MatchPlayerScorePoint extends Model {

    public $timestamps = false;

    public function definition(){
        return $this->belongsTo('BoardGameScores\GamePoint', 'game_point_id');
    }

}
