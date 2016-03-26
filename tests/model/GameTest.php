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

    public function testGamePointsStructure(){
        $game = Game::where('name', 'Carcassonne')->firstOrFail();
        $this->assertCount(1, $game->game_points);
        $this->assertEquals('Points', $game->game_points[0]->label);
        $this->assertEquals(['Points'], 
            $this->pluck($game->game_points-> sortBy('order')->toArray(), 'label'));
        $this->assertFalse($game->game_points->get(0)->is_negative);

        $game = Game::where('name', 'Power Grid')->firstOrFail();
        $this->assertCount(3, $game->game_points);
        $this->assertEquals(['Supplied cities', 'Cash', 'Cities'], 
            $this->pluck($game->game_points-> sortBy('order')->toArray(), 'label'));

        $game = Game::where('name', 'No Thanks!')->firstOrFail();
        $this->assertCount(1, $game->game_points);
        $this->assertEquals(['Points'], 
            $this->pluck($game->game_points-> sortBy('order')->toArray(), 'label'));
        $this->assertTrue($game->game_points->get(0)->is_negative);
    }

    private function pluck($array, $key){
        return Illuminate\Support\Arr::pluck($array, $key);
    }

    public function testBuildScorePoints(){
        $game = Game::where('name', 'Power Grid')->firstOrFail();
        $scorepoints = $game->buildScorePoints([15, 120]);
        $this->assertCount(2, $scorepoints);
        $this->assertEquals('Supplied cities', $scorepoints[0]->definition->label);
        $this->assertEquals(15, $scorepoints[0]->value);
        $this->assertEquals('Cash', $scorepoints[1]->definition->label);
        $this->assertEquals(120, $scorepoints[1]->value);
    }

}
