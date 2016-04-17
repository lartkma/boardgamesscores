<?php namespace BoardGameScores\Http\Requests;

use BoardGameScores\Http\Requests\Request;
use BoardGameScores\Player;

class StorePlayerRequest extends Request {

    private $new_player;

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
            'name' => 'required',
		];
    }

    public function new_player(){
        if($this->new_player == NULL){
            $this->new_player = new Player;
            $this->new_player->name = $this->input('name');
            $this->new_player->bga_nick = $this->input('bga_nick');
        }
        return $this->new_player;
    }

}
