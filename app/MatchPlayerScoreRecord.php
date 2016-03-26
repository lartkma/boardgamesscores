<?php namespace BoardGameScores;

use \DB;
use Illuminate\Support\Collection;

class MatchPlayerScoreRecord {

    private $inner_id;
    public $score;
    public $point_order;
    
    private function __construct($id, $score, $point_order){
        $this->inner_id = $id;
        $this->score = $score;
        $this->point_order = $point_order;
    }

    public static function getRecords(){
        $collection = new Collection;
        $records = DB::table('match_player_score_records')->get();
        foreach($records as $record_row){
            $collection->push(new MatchPlayerScoreRecord(
                $record_row->id,
                MatchPlayerScore::find($record_row->match_player_score_id),
                $record_row->point_order
            ));
        }
        return $collection;
    }

    public static function getRecordByGame($game_or_id, $number_players){
        if($game_or_id instanceof Game){
            $game_id = $game_or_id->id;
        }else{
            $game_id = $game_or_id;
        }
        $record_row = DB::table('match_player_score_records')->
            where('game_id', $game_id)->
            where('number_players', $number_players)->
            first();
        if($record_row == NULL){
            return NULL;
        }else{
            return new MatchPlayerScoreRecord(
                $record_row->id,
                MatchPlayerScore::find($record_row->match_player_score_id),
                $record_row->point_order
            );
        }
    }

    public static function saveRecord($game_score, $point_order){
        $currentRecord = self::getRecordByGame($game_score->game, $game_score->number_players);
        if(is_null($currentRecord)){
            $new_id = DB::table('match_player_score_records')->insertGetId([
                'game_id' => $game_score->game->id,
                'number_players' => $game_score->number_players,
                'match_player_score_id' => $game_score->id,
                'point_order' => $point_order,
            ]);
            return new MatchPlayerScoreRecord($new_id, $game_score, $point_order);
        }else{
            $id = $currentRecord->inner_id;
            DB::table('match_player_score_records')->
                where('id', $id)->
                update([
                    'match_player_score_id' => $game_score->id,
                    'point_order' => $point_order,
                ]);
            return new MatchPlayerScoreRecord($id, $game_score, $point_order);
        }
    }



}
