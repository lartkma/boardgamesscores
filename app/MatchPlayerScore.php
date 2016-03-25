<?php namespace BoardGameScores;

use Illuminate\Database\Eloquent\Model;

class MatchPlayerScore extends Model {

    public function game(){
        return $this->belongsTo('BoardGameScores\Game');
    }

    public function player(){
        return $this->belongsTo('BoardGameScores\Player');
    }

    public function points(){
        return $this->hasMany('BoardGameScores\MatchPlayerScorePoint');
    }

}
