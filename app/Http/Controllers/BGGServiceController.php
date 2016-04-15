<?php namespace BoardGameScores\Http\Controllers;

use BoardGameScores\Http\Requests;
use BoardGameScores\Http\Controllers\Controller;
use BoardGameScores\Services\BGGService;

use Illuminate\Http\Request;

class BGGServiceController extends Controller {

	public function search(Request $req) {
        $search_term = $req->query('q', NULL);
        if($search_term === NULL){
            return response('Enter a search term (?q)', 404);
        }else{
            return response()->json(BGGService::search($search_term));
        }
	}

    public function getGame($game_id){
        return response()->json(BGGService::gameDetail($game_id));
    }


}
