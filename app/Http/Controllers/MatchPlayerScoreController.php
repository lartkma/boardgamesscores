<?php namespace BoardGameScores\Http\Controllers;

use BoardGameScores\Http\Requests;
use BoardGameScores\Http\Requests\StoreMatchPlayerScoreRequest;
use BoardGameScores\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Lang;

class MatchPlayerScoreController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	//public function index(){
		//
	//}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
    public function create(){
        return view('matchscores.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(StoreMatchPlayerScoreRequest $req){
        $req->new_matchplayerscore()->save();
        $req->new_matchplayerscore()->points()->saveMany(
            $req->new_matchplayerscore_points());
        $is_a_record = $req->new_matchplayerscore()->checkAndSaveForRecord();
        if($is_a_record){
            return redirect('/')->withSuccess(
                Lang::get('matchscores.success_message_record', [
                    'name' => $req->player()->name,
                    'game' => $req->game()->name,
                    'players_msg' => Lang::choice('matchscores.record_players', $req->num_players()),
                ]));
        }else{
            return redirect('/')->withSuccess(Lang::get('matchscores.success_message'));
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	//public function show($id){
		//
	//}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	//public function edit($id){
		//
	//}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	//public function update($id){
		//
	//}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	//public function destroy($id){
		//
	//}

}
