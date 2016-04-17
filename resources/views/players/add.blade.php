@extends('layouts.master')
@section('title', Lang::get('players.title_new'))
@section('header')
    <h1>@lang('players.title_new')</h1>
@stop
@section('content')
    {!! Form::open(['url' => 'players']) !!}
        <div class="form-group">
            {!! Form::label('name', Lang::get('players.label_name')) !!}
            {!! Form::text('name', null, ['class'=>'form-control', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('bga_nick', Lang::get('players.label_bga_nick')) !!}
            {!! Form::text('bga_nick', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="@lang('terms.save')" />
        </div>
    {!! Form::close() !!}
@stop
