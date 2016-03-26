<?php

use BoardGameScores\Game;
use BoardGameScores\Player;
use BoardGameScores\MatchPlayerScore;
use BoardGameScores\MatchPlayerScorePoint;

class RankingComparisonTest extends TestCase {

    public function setUp(){
        parent::setUp();
        parent::setUpDatabase('OnlyGamesPlayersDatabaseSeeder');
    }

    public function testSimpleComparing(){
        $gamedef = Game::find(1);

        $game1 = new MatchPlayerScore;
        $game1->game()->associate($gamedef);
        $game1->player()->associate(Player::find(1));
        $game1->number_players=4;
        $game1->save();
        $game1->points()->saveMany($gamedef->buildScorePoints([40]));

        $game2 = new MatchPlayerScore;
        $game2->game()->associate($gamedef);
        $game2->player()->associate(Player::find(2));
        $game2->number_players=4;
        $game2->save();
        $game2->points()->saveMany($gamedef->buildScorePoints([45]));

        $this->assertEquals(-1, $game1->compareForRanking($game2));
        $this->assertEquals( 1, $game2->compareForRanking($game1));
    }

    public function testSimpleComparingEquals(){
        $gamedef = Game::find(1);

        $game1 = new MatchPlayerScore;
        $game1->game()->associate($gamedef);
        $game1->player()->associate(Player::find(1));
        $game1->number_players=4;
        $game1->save();
        $game1->points()->saveMany($gamedef->buildScorePoints([40]));

        $game2 = new MatchPlayerScore;
        $game2->game()->associate($gamedef);
        $game2->player()->associate(Player::find(2));
        $game2->number_players=4;
        $game2->save();
        $game2->points()->saveMany($gamedef->buildScorePoints([40]));

        $this->assertEquals(0, $game1->compareForRanking($game2));
        $this->assertEquals(0, $game2->compareForRanking($game1));
    }

}
