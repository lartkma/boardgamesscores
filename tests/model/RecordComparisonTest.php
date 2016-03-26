<?php

use BoardGameScores\Game;
use BoardGameScores\Player;
use BoardGameScores\MatchPlayerScore;
use BoardGameScores\MatchPlayerScorePoint;

class RecordComparisonTest extends TestCase {

    public function setUp(){
        parent::setUp();
        parent::setUpDatabase('OnlyGamesPlayersDatabaseSeeder');
    }

    public function testSimpleComparing(){
        $gamedef = Game::where('name', 'Carcassonne')->firstOrFail();

        $game1 = $this->buildMatchPlayerScore($gamedef, 1, 4);
        $game1->points()->saveMany($gamedef->buildScorePoints([40]));

        $game2 = $this->buildMatchPlayerScore($gamedef, 2, 4);
        $game2->points()->saveMany($gamedef->buildScorePoints([45]));

        $this->assertEquals(-1, $game1->compareForRecord($game2));
        $this->assertEquals( 1, $game2->compareForRecord($game1));
    }

    public function testSimpleComparingEquals(){
        $gamedef = Game::where('name', 'Carcassonne')->firstOrFail();

        $game1 = $this->buildMatchPlayerScore($gamedef, 1, 4);
        $game1->points()->saveMany($gamedef->buildScorePoints([40]));

        $game2 = $this->buildMatchPlayerScore($gamedef, 2, 4);
        $game2->points()->saveMany($gamedef->buildScorePoints([40]));

        $this->assertEquals(0, $game1->compareForRecord($game2));
        $this->assertEquals(0, $game2->compareForRecord($game1));
    }

    public function testComparingNegative(){
        $gamedef = Game::where('name', 'No Thanks!')->firstOrFail();

        $game1 = $this->buildMatchPlayerScore($gamedef, 1, 4);
        $game1->points()->saveMany($gamedef->buildScorePoints([25]));

        $game2 = $this->buildMatchPlayerScore($gamedef, 2, 4);
        $game2->points()->saveMany($gamedef->buildScorePoints([16]));

        $this->assertEquals(-1, $game1->compareForRecord($game2));
        $this->assertEquals( 1, $game2->compareForRecord($game1));
    }

    public function testMultiplePointsComplete(){
        $gamedef = Game::where('name', 'Power Grid')->firstOrFail();

        $game1 = $this->buildMatchPlayerScore($gamedef, 1, 4);
        $game1->points()->saveMany($gamedef->buildScorePoints([15, 90, 17]));

        $game2 = $this->buildMatchPlayerScore($gamedef, 2, 4);
        $game2->points()->saveMany($gamedef->buildScorePoints([15, 110, 15]));

        $this->assertEquals(-2, $game1->compareForRecord($game2));
        $this->assertEquals( 2, $game2->compareForRecord($game1));
    }

    public function testMultiplePointsIncompleteDifferentPlayers(){
        $gamedef = Game::where('name', 'Power Grid')->firstOrFail();

        $game1 = $this->buildMatchPlayerScore($gamedef, 1, 4);
        $game1->points()->saveMany($gamedef->buildScorePoints([15, 90]));

        $game2 = $this->buildMatchPlayerScore($gamedef, 2, 4);
        $game2->points()->saveMany($gamedef->buildScorePoints([15, 90, 15]));

        $this->assertEquals( 2, $game1->compareForRecord($game2));
        $this->assertEquals(-2, $game2->compareForRecord($game1));
    }

    public function testMultiplePointsIncompleteSamePlayer(){
        $gamedef = Game::where('name', 'Power Grid')->firstOrFail();

        $game1 = $this->buildMatchPlayerScore($gamedef, 1, 4);
        $game1->points()->saveMany($gamedef->buildScorePoints([15, 90]));

        $game2 = $this->buildMatchPlayerScore($gamedef, 1, 4);
        $game2->points()->saveMany($gamedef->buildScorePoints([15, 90, 15]));

        $this->assertEquals(-3, $game1->compareForRecord($game2));
        $this->assertEquals( 3, $game2->compareForRecord($game1));
    }

    public function testMultiplePointsIncompleteSame(){
        $gamedef = Game::where('name', 'Power Grid')->firstOrFail();

        $game1 = $this->buildMatchPlayerScore($gamedef, 1, 4);
        $game1->points()->saveMany($gamedef->buildScorePoints([15, 90]));

        $game2 = $this->buildMatchPlayerScore($gamedef, 2, 4);
        $game2->points()->saveMany($gamedef->buildScorePoints([15, 90]));

        $this->assertEquals(0, $game1->compareForRecord($game2));
        $this->assertEquals(0, $game2->compareForRecord($game1));
    }

    private function buildMatchPlayerScore($gamedef, $player_id, $number_players){
        $game = new MatchPlayerScore;
        $game->game()->associate($gamedef);
        $game->player()->associate(Player::find($player_id));
        $game->number_players = $number_players;
        $game->save();
        return $game;
    }

}
