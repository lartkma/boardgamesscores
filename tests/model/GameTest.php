<?php

use BoardGameScores\Game;

class ModelTest extends TestCase {

    public function setUp(){
        parent::setUp();
        parent::setUpDatabase();
    }

    public function testGetGame(){
        $carcassonne = Game::find(1);
        $this->assertEquals('Carcassonne', $carcassonne->name);
    }

}
