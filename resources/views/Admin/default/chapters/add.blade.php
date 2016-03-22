<div class="tab-content">
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
        {{ Form::text('pos', ( isset($oData) ? $oData->pos : null), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('icon', Lang::get('chapters.form.icon')) }}
        {{ Form::file('icon', array() ) }}
    </div>
    <div class="form-group">
        {{ Form::label('is_active', Lang::get('chapters.form.is_active')) }}
        <div class="radio">
            {{ Form::radio('is_active', '1', isset($oData) ? $oData->is_active === '1' : true, array('id' => 'is_active_yes')) }}
            {{ Form::label('is_active_yes', Lang::get('table_field.lists.yes') ) }}
        </div>
        <div class="radio">
            {{ Form::radio('is_active', '0', isset($oData) ? $oData->is_active === '0' : false, array('id' => 'is_active_no')) }}
            {{ Form::label('is_active_no', Lang::get('table_field.lists.no') ) }}
        </div>
    </div>
    {{ Form::hidden('sType', isset($oData) ? $oData->type_chapter : $sType) }}
    {{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}
</div>
