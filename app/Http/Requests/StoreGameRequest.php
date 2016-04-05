<?php namespace BoardGameScores\Http\Requests;

use BoardGameScores\Game;
use BoardGameScores\GamePoint;
use BoardGameScores\Http\Requests\Request;

class StoreGameRequest extends Request {

    private $new_game;
    private $new_game_points;

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
        $max_players_min = $this->has('min_players') ?
            $this->input('min_players') : 1;
		return [
            'name' => 'required',
            'min_players' => 'required|numeric|min:1',
            'max_players' => 'required|numeric|min:'.$max_players_min,
            'points' => 'required|array',
		];
	}

    public function new_game(){
        if($this->new_game == NULL){
            $this->new_game = new Game;
            $this->new_game->name = $this->input('name');
            $this->new_game->bgg_id = $this->input('bgg_id');
            $this->new_game->min_players = $this->input('min_players');
            $this->new_game->max_players = $this->input('max_players');
        }
        return $this->new_game;
    }

    public function new_game_points(){
        if($this->new_game_points == NULL){
            $this->new_game_points = [];
            foreach($this->input('points') as $point){
                $object = new GamePoint;
                $object->label = $point['label'];
                if(isset($point['is_negative'])){
                    $object->is_negative = ($point['is_negative'] == 'true');
                }
                $this->new_game_points[] = $object;
            }
        }
        return $this->new_game_points;
    }

}
