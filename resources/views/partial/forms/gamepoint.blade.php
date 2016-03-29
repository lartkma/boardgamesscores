<?php if(!isset($index)) $index = 0 ?>
<div class="form-group">
    {!! Form::label("points[$index][label]", Lang::get('games.label_name')) !!}
    {!! Form::text("points[$index][label]", null, [
        'class'=>'form-control', 
        'placeholder'=>Lang::get('games.default_point_label'),
        'required'=>'required',
    ]) !!}
</div>
<div class="checkbox">
    <label>
        {!! Form::checkbox("points[$index][is_negative]", 'true') !!}
        @lang('games.label_is_negative')
    </label>
</div>
