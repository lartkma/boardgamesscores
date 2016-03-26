<?php namespace BoardGameScores;

use BoardGameScores\MatchPlayerScoreRecord as Records;
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

    public function checkAndSaveForRecord(){
        $current_record = Records::getRecordByGame($this->game, $this->number_players);
        $is_a_record = false;
        if(is_null($current_record)){
            $is_a_record = true;
            $point_order = $this->maxOrder();
        }else{
            $compare = $this->compareForRanking($current_record->score);
            if($compare > 0){
                $is_a_record = true;
                $point_order = $compare;
            }
        }
        if($is_a_record){
            Records::saveRecord($this, $point_order);
        }
        return $is_a_record;
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
                $thisPoints = $thisPoints->first()->value;
                $otherPoints = $otherPoints->first()->value;
                if($thisPoints > $otherPoints){
                    return $element->order * $factor;
                }else if($thisPoints < $otherPoints){
                    return -1 * $element->order * $factor;
                }
            }
        }
        return 0;
    }

    private function maxOrder(){
        $max = 1;
        foreach($this->points as $point){
            if($point->value > $max){
                $max = $point->value;
            }
        }
        return $max;
    }

}
