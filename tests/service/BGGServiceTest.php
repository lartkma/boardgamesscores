<?php

use BoardGameScores\Services\BGGService;

class BGGServiceTest extends TestCase {
    
    public function testSearch(){
        $search = BGGService::search('carca');
        $carcassonne= array_values(array_filter($search, function($value){
            return $value['name'] == 'Carcassonne';
        }));

        $this->assertCount(1, $carcassonne);
        $this->assertEquals(822, $carcassonne[0]['id']);
        $this->assertEquals(2000, $carcassonne[0]['year']);
    }

}
