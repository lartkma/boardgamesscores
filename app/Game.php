<?php namespace BoardGameScores;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {

    public $timestamps = false;

    public function game_points(){
        return $this->hasMany('BoardGameScores\GamePoint');
    }

    public function buildScorePoints($pointsArray){
        $modelsArray = [];
        $pIndex = 0;
        foreach($this->game_points->sortBy('order') as $gamepoint){
            if(count($pointsArray) > $pIndex){
                $model = new MatchPlayerScorePoint;
                $model->definition()->associate($gamepoint);
                $model->value = $pointsArray[$pIndex];
                $modelsArray[] = $model;
                $pIndex += 1;
            } else {
                break;
            }
        }
        return $modelsArray;
    }

}
