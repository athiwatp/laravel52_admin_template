<div class="form-group">
    {{ Form::label('name', Lang::get('users.form.name') ) }}
    {{ Form::text('name', ( isset($oData) ? $oData->name : null), array('required', 'minlength' => 3, 'maxlength' => 255, 'class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('email', Lang::get('users.form.email') ) }}
    {{ Form::text('email', ( isset($oData) ? $oData->email : null), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('phone', Lang::get('users.form.phone') ) }}
    {{ Form::text('phone', ( isset($oData) ? $oData->phone : null), array('class' => 'form-control phone-mask')) }}
</div>

<div class="form-group">
    {{ Form::label('group', Lang::get('users.form.group_name') ) }}
    {{ Form::select('group', $checkGroup, ( $oData ? $oData->group : null), array('class' => 'form-control')) }}
</div>

{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}
