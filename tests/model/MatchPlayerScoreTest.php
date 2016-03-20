<?php

use BoardGameScores\MatchPlayerScore;

class MatchPlayerScoreTest extends TestCase {

    public function setUp(){
        parent::setUp();
        parent::setUpDatabase();
    }

    public function testGetMatchPlayerScore(){
        $match = MatchPlayerScore::find(1);
        $this->assertEquals('Carcassonne', $match->game->name);
        $this->assertEquals('Oscar Eduardo', $match->player->name);
        $this->assertEquals(4, $match->number_players);
    }

}
