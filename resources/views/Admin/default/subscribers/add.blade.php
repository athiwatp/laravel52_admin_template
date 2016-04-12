<div class="form-group">
    {{ Form::label('email', Lang::get('subscribers.form.email') ) }}
    {{ Form::text('email', ( isset($oData) ? $oData->email : null), array('class' => 'form-control', ( empty($oData) ? '' : 'disabled') )) }}
</div>

<div class="form-group">
    {{ Form::label('is_active', Lang::get('subscribers.form.active')) }}
    <div class="radio">
        {!! Form::_label('is_active_yes', Form::radio('is_active', '1', isset($oData) ? $oData->is_active === '1' : true, array('id' => 'is_active_yes')) . ' ' . Lang::get('table_field.lists.yes') ) !!}
    </div>
    <div class="radio">
        {!! Form::_label('is_active_no', Form::radio('is_active', '0', isset($oData) ? $oData->is_active === '0' : false, array('id' => 'is_active_no')) . ' ' . Lang::get('table_field.lists.no')) !!}
    </div>
</div>
{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}