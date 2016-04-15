<?php namespace BoardGameScores\Services;

class BGGService {
    
    public static function search($search_term){
        $url = env('BGG_HOST', 'http://www.boardgamegeek.com').
            '/xmlapi/search?search='.rawurlencode($search_term);
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

    public static function gameDetail($game_id){
        $url = env('BGG_HOST', 'http://www.boardgamegeek.com').
            '/xmlapi/boardgame/'.rawurlencode($game_id);
        $boardgames = simplexml_load_file($url);
        $boardgame = $boardgames->boardgame[0];
        $result = [];
        $result['min_players'] = isset($boardgame->minplayers) ?
            intval($boardgame->minplayers) : 0;
        $result['max_players'] = isset($boardgame->maxplayers) ?
            intval($boardgame->maxplayers) : 0;
        return $result;
    }
}
