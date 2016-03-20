<?php namespace BoardGameScores;

use Illuminate\Database\Eloquent\Model;

class GamePoint extends Model {

    public $timestamps = false;
    protected $casts = [
        'is_negative' => 'boolean',
    ];

}
