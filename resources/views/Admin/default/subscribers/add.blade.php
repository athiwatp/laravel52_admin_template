<div class="form-group input-group">
    <span class="input-group-addon">@</span>
    {{ 
        Form::text('email', ( isset($oData) ? $oData->email : null), array(
            'required',
            'minlength' => 3,
            'maxlength' => 255,
            'placeholder' => Lang::get('subscribers.form.email'),
            'class' => 'form-control',
            ( empty($oData) ? '' : 'readonly')
            )
        )
    }}
</div>

@if ( empty($oData) || ( $oData && $oData->is_active == '0' ) )
<div class="form-group">
    {!!
        Form::_label('send_activation_email',
            Form::checkbox('send_activation_email', '1', false, ['id' => 'send_activation_email']) .
            ' ' . Lang::get('subscribers.form.send_activation_email')
        )
    !!}
</div>
@endif

{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}

@if( env('APP_ENV', 'testing') )
    {{ Form::hidden('is_active', isset($oData) ? $oData->is_active : 1) }}
@endif