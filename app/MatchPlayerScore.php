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

    public function compareForRanking(MatchPlayerScore $other){
        $pointElements = $this->game->game_points->sortBy('order');
        foreach($pointElements as $element){
            $factor = ($element->is_negative ? -1 : 1);
            $thisPoints = $this->points->where('game_point_id', $element->id);
            $otherPoints = $other->points->where('game_point_id', $element->id);
            if($thisPoints->isEmpty() && $otherPoints->isEmpty()){
                return 0;
            }else if($thisPoints->isEmpty() || $otherPoints->isEmpty()){
                if($this->player->id == $other->player->id){
                    return ($thisPoints->isEmpty() ? -1 : 1) *
                        $element->order * $factor;
                }else{
                    return ($thisPoints->isEmpty() ? 1 : -1) *
                        ($element->order - 1) * $factor;
                }
            }else{
                $thisPoints = $thisPoints[0]->value;
                $otherPoints = $otherPoints[0]->value;
                if($thisPoints > $otherPoints){
                    return $element->order * $factor;
                }else if($thisPoints < $otherPoints){
                    return -1 * $element->order * $factor;
                }
            }
        }
        return 0;
    }

}
