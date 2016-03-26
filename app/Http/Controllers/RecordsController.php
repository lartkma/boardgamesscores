<?php namespace BoardGameScores\Http\Controllers;

use BoardGameScores\Http\Requests;
use BoardGameScores\Http\Controllers\Controller;
use BoardGameScores\MatchPlayerScoreRecord as Records;

use Illuminate\Http\Request;

class RecordsController extends Controller {

    public function board(){
        return view('recordboard', ['records'=>Records::getRecords()]);
    }

}
