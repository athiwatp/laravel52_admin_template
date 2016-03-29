<div class="form-group">
    {{ Form::label('name', Lang::get('users.reg.name') ) }}
    {{ Form::text('name', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('email', Lang::get('users.auth.e-mail') ) }}
    {{ Form::text('email', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('password', Lang::get('users.auth.password') ) }}
    {{ Form::password('password', array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('password_confirmation', Lang::get('users.reg.confirm_pass') ) }}
    {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
</div>
{{ Form::hidden('id', 0) }}