<?php

use BoardGameScores\Game;
use BoardGameScores\Player;
use BoardGameScores\MatchPlayerScore;
use BoardGameScores\MatchPlayerScoreRecord as Records;

class RecordOperationTest extends TestCase {

    public function setUp(){
        parent::setUp();
        parent::setUpDatabase('OnlyGamesPlayersDatabaseSeeder');
    }

    public function testRecords(){
        $gamedef = Game::where('name', 'Carcassonne')->firstOrFail();

        $game = $this->buildMatchPlayerScore($gamedef, 1, 4);
        $game->points()->saveMany($gamedef->buildScorePoints([50]));
        $game->checkAndSaveForRecord();

        $game = $this->buildMatchPlayerScore($gamedef, 2, 4);
        $game->points()->saveMany($gamedef->buildScorePoints([62]));
        $game->checkAndSaveForRecord();

        $game = $this->buildMatchPlayerScore($gamedef, 2, 4);
        $game->points()->saveMany($gamedef->buildScorePoints([54]));
        $game->checkAndSaveForRecord();

        $game = $this->buildMatchPlayerScore($gamedef, 1, 5);
        $game->points()->saveMany($gamedef->buildScorePoints([65]));
        $game->checkAndSaveForRecord();

        $game = $this->buildMatchPlayerScore($gamedef, 3, 5);
        $game->points()->saveMany($gamedef->buildScorePoints([61]));
        $game->checkAndSaveForRecord();

        $gamedef = Game::where('name', 'Power Grid')->firstOrFail();

        $game = $this->buildMatchPlayerScore($gamedef, 1, 5);
        $game->points()->saveMany($gamedef->buildScorePoints([15, 90]));
        $game->checkAndSaveForRecord();

        $game = $this->buildMatchPlayerScore($gamedef, 2, 5);
        $game->points()->saveMany($gamedef->buildScorePoints([14, 110, 16]));
        $game->checkAndSaveForRecord();

        $game = $this->buildMatchPlayerScore($gamedef, 3, 5);
        $game->points()->saveMany($gamedef->buildScorePoints([15, 40, 15]));
        $game->checkAndSaveForRecord();

        $game = $this->buildMatchPlayerScore($gamedef, 1, 5);
        $game->points()->saveMany($gamedef->buildScorePoints([15, 90, 15]));
        $game->checkAndSaveForRecord();
        
        $gamedef = Game::where('name', 'No Thanks!')->firstOrFail();

        $game = $this->buildMatchPlayerScore($gamedef, 1, 4);
        $game->points()->saveMany($gamedef->buildScorePoints([25]));
        $game->checkAndSaveForRecord();

        $game = $this->buildMatchPlayerScore($gamedef, 1, 4);
        $game->points()->saveMany($gamedef->buildScorePoints([14]));
        $game->checkAndSaveForRecord();

        $game = $this->buildMatchPlayerScore($gamedef, 2, 4);
        $game->points()->saveMany($gamedef->buildScorePoints([10]));
        $game->checkAndSaveForRecord();

        $records = Records::getRecords();

        $this->assertCount(4, $records);

        $this->assertCount(1, $records->filter(function($element){
            return $element->score->game->name == "Carcassonne" &&
                $element->score->number_players == 4 &&
                $element->score->player->id == 2 &&
                $element->score->points[0]->value == 62 &&
                $element->point_order == 1;
        }));

        $this->assertCount(1, $records->filter(function($element){
            return $element->score->game->name == "Carcassonne" &&
                $element->score->number_players == 5 &&
                $element->score->player->id == 1 &&
                $element->score->points[0]->value == 65 &&
                $element->point_order == 1;
        }));

        $this->assertCount(1, $records->filter(function($element){
            return $element->score->game->name == "Power Grid" &&
                $element->score->number_players == 5 &&
                $element->score->player->id == 1 &&
                $element->score->points[0]->value == 15 &&
                $element->point_order == 3;
        }));

        $this->assertCount(1, $records->filter(function($element){
            return $element->score->game->name == "No Thanks!" &&
                $element->score->number_players == 4 &&
                $element->score->player->id == 2 &&
                $element->score->points[0]->value == 10 &&
                $element->point_order == 1;
        }));
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
