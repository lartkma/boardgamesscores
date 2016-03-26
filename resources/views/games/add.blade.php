@extends('layouts.master')
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
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('bgg_id', Lang::get('games.label_bgg_id')) !!}
            {!! Form::number('bgg_id', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('min_players', Lang::get('games.label_min_players')) !!}
            {!! Form::number('min_players', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('max_players', Lang::get('games.label_max_players')) !!}
            {!! Form::number('max_players', null, ['class'=>'form-control']) !!}
        </div>
    </fieldset>
    <fieldset>
        <legend>@lang('games.header_victory_points')</legend>
        @include('partial.forms.gamepoint')
    </fieldset>
    <fieldset>
        <legend>@lang('games.header_tie_points')</legend>
        <input type="button" class="btn btn-default" value="@lang('terms.add')" id="btn-add-tie"/>
        <div id="container-tie-points"></div>
    </fieldset>
    {!! Form::close() !!}
    <script id="template-tie-point" type="text/x-handlebars-template">
        <div class="tie-point">
            @include('partial.forms.gamepoint')
        </div>
    </script>
@stop
