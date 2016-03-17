<div class="tab-content">
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
        {{ Form::text('phone', ( isset($oData) ? $oData->phone : null), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('is_admin', Lang::get('users.form.parent_id') ) }}
        {{ Form::number('is_admin', ( isset($oData) ? $oData->is_admin : null), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('is_verified', Lang::get('users.form.is_verified') ) }}
        {{ Form::number('is_verified', ( isset($oData) ? $oData->is_verified : null), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('is_admin', Lang::get('users.form.is_admin')) }}
        <div class="radio">
            {{ Form::radio('is_admin', '1', isset($oData) ? $oData->is_admin === '1' : true, array('id' => 'is_admin_yes')) }}
            {{ Form::label('is_admin_yes', Lang::get('table_field.lists.yes') ) }}
        </div>
        <div class="radio">
            {{ Form::radio('is_admin', '0', isset($oData) ? $oData->is_admin === '0' : false, array('id' => 'is_admin_no')) }}
            {{ Form::label('is_admin_no', Lang::get('table_field.lists.no') ) }}
        </div>
    </div>
{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}
</div>