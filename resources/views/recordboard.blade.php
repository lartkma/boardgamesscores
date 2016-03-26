@extends('layouts.master')
@section('title', Lang::get('terms.recordboard'))
@section('content')
    <div class="page-header clearfix">
        <img class="pull-left" src="{{asset('images/logo.png')}}" />
        <h1 class="pull-right">@lang('terms.recordboard')</h1>
    </div>
    <div class="table-responsive">
        <table class="table table-stripped">
            <tr>
                <th>@lang('terms.game')</th>
                <th>@lang('terms.numplayers')</th>
                <th>@lang('terms.player')</th>
                <th>@lang('terms.record')</th>
            </tr>
            @foreach($records as $record)
            <tr>
                <td>{{$record->score->game->name}}</td>
                <td>{{$record->score->number_players}}</td>
                <td>{{$record->score->player->name}}</td>
                <?php $point1 = $record->score->points[0]; ?>
                <td>{{number_format($point1->value, (fmod($point1->value, 1)==0 ? 0 : 1) , '.', ' ')}} 
                {{$point1->definition->label}}
                @if($record->point_order > 1)
                    <small class="text-muted"><i>
                    (@for($i = 1; $i < $record->point_order; $i++){{--
                        --}}<?php $point = $record->score->points[$i] ?>{{--
                        --}}@if($i != 1) ,@endif{{--
                        --}}{{number_format($point->value, (fmod($point->value, 1)==0 ? 0 : 1) , '.', ' ')}} 
                        {{$point->definition->label}}{{--
                    --}}@endfor)
                    </i></small>
                @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@stop
