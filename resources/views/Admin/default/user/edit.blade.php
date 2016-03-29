<div class="form-group">
    {{ Form::label('name', Lang::get('users.form.name') ) }}
    {{ Form::text('name', ( isset($oData) ? $oData->name : null), array('class' => 'form-control')) }}
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
    {{ Form::label('is_published', Lang::get('users.form.is_admin')) }}
    <div class="radio">
        {!! Form::_label('administrator_yes', Form::radio('is_admin', '1', isset($oData) ? $oData->is_admin === '1' : true, array('id' => 'administrator_yes')) . ' ' . Lang::get('table_field.lists.yes') ) !!}
    </div>
    <div class="radio">
        {!! Form::_label('administrator_no', Form::radio('is_admin', '0', isset($oData) ? $oData->is_admin === '0' : false, array('id' => 'administrator_no')) . ' ' . Lang::get('table_field.lists.no')) !!}
    </div>
</div>
{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}
