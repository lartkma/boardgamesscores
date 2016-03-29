@extends('layouts.master', 
    ['add_js'=>
        [asset('js/handlebars.min.js'), asset('js/game-add.js')]
    ])       
@section('title', Lang::get('games.title_new'))
@section('content')
    <div class="page-header">
        <h1>@lang('games.title_new')</h1>
    </div>
    {!! Form::open(['url' => 'game']) !!}
    <fieldset>
        <legend>@lang('games.header_general')</legend>
        <div class="form-group">
            {!! Form::label('name', Lang::get('games.label_name')) !!}
            {!! Form::text('name', null, ['class'=>'form-control', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('bgg_id', Lang::get('games.label_bgg_id')) !!}
            {!! Form::number('bgg_id', null, ['class'=>'form-control', 'min'=>1]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('min_players', Lang::get('games.label_min_players')) !!}
            {!! Form::number('min_players', null, ['class'=>'form-control', 'min'=>1, 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('max_players', Lang::get('games.label_max_players')) !!}
            {!! Form::number('max_players', null, ['class'=>'form-control', 'min'=>1, 'required'=>'required']) !!}
        </div>
    </fieldset>
    <fieldset>
        <legend>@lang('games.header_victory_points')</legend>
        @include('partial.forms.gamepoint', ['index'=>0])
    </fieldset>
    <fieldset>
        <legend>@lang('games.header_tie_points')</legend>
        <div class="form-group">
            <input type="button" class="btn btn-default" value="@lang('terms.add')" id="btn-add-tie"/>
        </div>
        <div id="container-tie-points"></div>
    </fieldset>
    <hr />
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="@lang('terms.save')" />
    </div>
    {!! Form::close() !!}
    <script id="template-tie-point" type="text/x-handlebars-template">
        <div class="tie-point">
            @include('partial.forms.gamepoint', ['index'=>'@{{index}}'])
        </div>
    </script>
@stop