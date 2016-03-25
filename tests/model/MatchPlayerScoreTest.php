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
        $this->assertEquals(50, $match->points[0]->value);
        $this->assertEquals('Points', $match->points[0]->definition->label);
    }

}
