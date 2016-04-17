<?php namespace BoardGameScores\Http\Controllers;

use BoardGameScores\Http\Requests;
use BoardGameScores\Http\Requests\StoreGameRequest;
use BoardGameScores\Http\Controllers\Controller;
use BoardGameScores\Game;

use Illuminate\Http\Request;
use Lang;

class GameController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    //public function index() {
        
    //}
    
    public function indexJSON(){
        return Game::all()->map(function($item){
            return [
                'id' => $item->id,
                'name' => $item->name,
            ];
        });
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
        return view('games.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(StoreGameRequest $req) {
        $req->new_game()->save();
        $req->new_game()->game_points()->saveMany($req->new_game_points());
        return redirect('/')->withSuccess(Lang::get('games.success_message'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	//public function show($id) {
		////
	//}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	//public function edit($id) {
		////
	//}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	//public function update($id) {
		////
	//}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	//public function destroy($id) {
		////
	//}

}
