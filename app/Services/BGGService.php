<?php namespace BoardGameScores\Services;

class BGGService {
    
    public static function search($search_term){
        $url = 'https://www.boardgamegeek.com/xmlapi/search?search='.rawurlencode($search_term);
        $boardgames = simplexml_load_file($url);
        $results = [];
        foreach($boardgames->boardgame as $boardgame){
            $result = [];
            $result['id'] = intval($boardgame['objectid']);
            $result['name'] = (string)$boardgame->name;
            if(isset($boardgame->yearpublished)){
                $result['year'] = intval($boardgame->yearpublished);
            }
            $results[] = $result;
        }
        return $results;
    }
}
