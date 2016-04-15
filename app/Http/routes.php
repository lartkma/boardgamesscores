<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'RecordsController@board');

Route::get('game/add', 'GameController@create');
Route::post('game', 'GameController@store');

Route::get('bgg/search', 'BGGServiceController@search');
Route::get('bgg/games/{game_id}', 'BGGServiceController@getGame');
