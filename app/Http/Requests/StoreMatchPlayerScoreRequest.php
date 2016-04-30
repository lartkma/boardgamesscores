<?php namespace BoardGameScores\Http\Requests;

use BoardGameScores\Game;
use BoardGameScores\Player;
use BoardGameScores\MatchPlayerScore;
use BoardGameScores\MatchPlayerScorePoint;
use BoardGameScores\Http\Requests\Request;

class StoreMatchPlayerScoreRequest extends Request {

    private $game;
    private $player;
    private $new_matchplayerscore;
    private $new_matchplayerscore_points;

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
            'game_id' => 'required',
            'player_id' => 'required',
            'number_players' => 'required|numeric',
            'points' => 'required|array|min:1',
		];
	}

    public function game(){
        if($this->game == NULL){
            $this->game = Game::find($this->input('game_id'));
        }
        return $this->game;
    }

    public function player(){
        if($this->player == NULL){
            $this->player = Player::find($this->input('player_id'));
        }
        return $this->player;
    }

    public function num_players(){
        return intval($this->input('number_players'));
    }

    public function new_matchplayerscore(){
        if($this->new_matchplayerscore == NULL){
            $new = new MatchPlayerScore();
            $new->game()->associate($this->game());
            $new->player()->associate($this->player());
            $new->number_players = $this->num_players();
            $this->new_matchplayerscore = $new;
        }
        return $this->new_matchplayerscore;
    }

    public function new_matchplayerscore_points(){
        if($this->new_matchplayerscore_points == NULL){
            $array = [];
            $match_points = $this->input('points');
            $game_point_defs = $this->game()->game_points->sortBy('order');
            for($i = 0, $n = count($game_point_defs); $i < $n; $i++){
                if(isset($match_points[$i])){
                    $object = new MatchPlayerScorePoint();
                    $object->definition()->associate($game_point_defs[$i]);
                    $object->value = $match_points[$i]['value'];
                    $array[] = $object;
                }
            }
            $this->new_matchplayerscore_points = $array;
        }
        return $this->new_matchplayerscore_points;
    }

}
