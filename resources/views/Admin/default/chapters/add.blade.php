<div class="form-group">
    {{ Form::label('title', Lang::get('chapters.form.title') ) }}
    {{ Form::text('title', ( isset($oData) ? $oData->title : null), array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('description', Lang::get('chapters.form.description') ) }}
    {{ Form::textarea('description', ( isset($oData) ? $oData->description : null), array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('pos', Lang::get('chapters.form.pos') ) }}
    {{ Form::number('pos', ( isset($oData) ? $oData->pos : null), array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('icon', Lang::get('chapters.form.icon')) }}
    {{ Form::file('icon', array() ) }}
</div>
<div class="form-group">
    {{ Form::label('is_important', Lang::get('chapters.form.is_active')) }}
    <div class="radio">
        {!! Form::_label('active_yes', Form::radio('is_active', '1', isset($oData) ? $oData->is_active === '1' : true, array('id' => 'active_yes')) . ' ' . Lang::get('table_field.lists.yes') ) !!}
    </div>
    <div class="radio">
        {!! Form::_label('active_no', Form::radio('is_active', '0', isset($oData) ? $oData->is_active === '0' : false, array('id' => 'active_no')) . ' ' . Lang::get('table_field.lists.no')) !!}
    </div>
</div>
{{ Form::hidden('sType', isset($oData) ? $oData->type_chapter : $sType) }}
{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}