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
        $gamepointdef = $gamedef->game_points[0];

        $game1 = new MatchPlayerScore;
        $game1->game()->associate($gamedef);
        $game1->player()->associate(Player::find(1));
        $game1->number_players=4;
        $game1->save();

        $gamepoint1 = new MatchPlayerScorePoint;
        $gamepoint1->definition()->associate($gamepointdef);
        $gamepoint1->value = 40;
        $game1->points()->save($gamepoint1);

        $game2 = new MatchPlayerScore;
        $game2->game()->associate($gamedef);
        $game2->player()->associate(Player::find(2));
        $game2->number_players=4;
        $game2->save();

        $gamepoint2 = new MatchPlayerScorePoint;
        $gamepoint2->definition()->associate($gamepointdef);
        $gamepoint2->value = 45;
        $game2->points()->save($gamepoint2);

        $this->assertEquals(-1, $game1->compareForRanking($game2));
        $this->assertEquals( 1, $game2->compareForRanking($game1));
    }

    public function testSimpleComparingEquals(){
        $gamedef = Game::find(1);
        $gamepointdef = $gamedef->game_points[0];

        $game1 = new MatchPlayerScore;
        $game1->game()->associate($gamedef);
        $game1->player()->associate(Player::find(1));
        $game1->number_players=4;
        $game1->save();

        $gamepoint1 = new MatchPlayerScorePoint;
        $gamepoint1->definition()->associate($gamepointdef);
        $gamepoint1->value = 40;
        $game1->points()->save($gamepoint1);

        $game2 = new MatchPlayerScore;
        $game2->game()->associate($gamedef);
        $game2->player()->associate(Player::find(2));
        $game2->number_players=4;
        $game2->save();

        $gamepoint2 = new MatchPlayerScorePoint;
        $gamepoint2->definition()->associate($gamepointdef);
        $gamepoint2->value = 40;
        $game2->points()->save($gamepoint2);

        $this->assertEquals(0, $game1->compareForRanking($game2));
        $this->assertEquals(0, $game2->compareForRanking($game1));
    }

}
