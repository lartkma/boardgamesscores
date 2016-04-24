@extends('layouts.master', 
    ['add_js'=>
        [asset('js/handlebars.min.js'), asset('js/jquery-ui.min.js'), asset('js/matchscore-add.js')],
     'add_css'=>
        [asset('css/jquery-ui.min.css')]
    ])
@section('title', Lang::get('matchscores.title_new'))
@section('header')
    <h1>@lang('matchscores.title_new')</h1>
@stop
@section('content')
    {!! Form::open(['url' => 'matchscores']) !!}
        <div class="form-group">
            {!! Form::label('game', Lang::get('matchscores.label_game')) !!}
            <div class="input-group">
                {!! Form::text('game', null, ['class'=>'form-control', 'required'=>'required']) !!}
                <span class="input-group-btn">
                    <a class="btn btn-default" aria-label="{{Lang::get('matchscores.label_add_game')}}" 
                            id="add-game-btn" href="{{url('games/add?redirect=matchscores')}}" tabindex="-1">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                </span>
            </div>
            {!! Form::hidden('game_id', null, ['id'=>'game_id']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('player', Lang::get('matchscores.label_player')) !!}
            <div class="input-group">
                {!! Form::text('player', null, ['class'=>'form-control', 'required'=>'required']) !!}
                <span class="input-group-btn">
                    <a class="btn btn-default" aria-label="{{Lang::get('matchscores.label_add_player')}}" 
                            id="add-player-btn" href="{{url('players/add?redirect=matchscores')}}" tabindex="-1">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                </span>
            </div>
            {!! Form::hidden('player_id', null, ['id'=>'player_id']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('number_players', Lang::get('matchscores.label_number_players')) !!}
            {!! Form::number('number_players', null, ['class'=>'form-control', 'min'=>1, 'required'=>'required']) !!}
        </div>
        <div id="game-points">
        </div>
        <div class="form-group">
            <input id="save-matchscore" type="submit" class="btn btn-primary" value="@lang('terms.save')" />
        </div>
    {!! Form::close() !!}
    <script id="template-game-point" type="text/x-handlebars-template">
        <div class="form-group">
            {!! Form::label('points[@{{index}}][value]', '@{{label}}' ) !!}
            {!! Form::number('points[@{{index}}][value]', null, ['class'=>'form-control']) !!}
        </div>
    </script>
@stop
