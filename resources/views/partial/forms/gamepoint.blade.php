<div class="form-group">
    {!! Form::label('points.label[]', Lang::get('games.label_name')) !!}
    {!! Form::text('points.label[]', null, ['class'=>'form-control', 'placeholder'=>Lang::get('games.default_point_label')]) !!}
</div>
<div class="checkbox">
    <label>
        {!! Form::checkbox('points.is_negative[]', 'true') !!}
        @lang('games.label_is_negative')
    </label>
</div>
