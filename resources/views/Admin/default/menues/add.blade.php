<div class="form-group">
    {{ Form::label('title', Lang::get('menues.form.title') ) }}
    {{ Form::text('title', ( isset($oData) ? $oData->title : null), array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('pos', Lang::get('menues.form.pos') ) }}
    {{ Form::text('pos', ( isset($oData) ? $oData->pos : null), array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('type_menu', Lang::get('menues.form.type_menu') ) }}
    {{ Form::select('type_menu', $aTypeMenues,( isset($oData) ? $oData->type_menu : null), array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('parent_id', Lang::get('menues.form.parent_id') ) }}
    {{ Form::select('parent_id', $aMenues, ( isset($oData) ? $oData->parent_id : null), array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('path', Lang::get('menues.form.path') ) }}
    {{ Form::text('path', ( isset($oData) ? $oData->path : null), array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('url', Lang::get('menues.form.url') ) }}
    {{ Form::text('url', ( isset($oData) ? $oData->url : null), array('class' => 'form-control')) }}
    {!! Form::_label('redirectable', Form::checkbox('is_redirectable', '1', isset($oData) && $oData->is_redirectable === '1' ? true : false , array('id' => 'redirectable')) . ' ' . Lang::get('menues.form.is_redirectable') ) !!}
</div>
<div class="form-group">
    {{ Form::label('url', Lang::get('menues.form.redirect_url') ) }}
    {{ Form::text('redirect_url', ( isset($oData) ? $oData->redirect_url : null ), array('class' => 'form-control')) }}
</div>
<div class="form-group">
    <div class="checkbox">
        {!! Form::_label('is_loaded_by_default', Form::checkbox('is_loaded_by_default', '1', isset($oData) && $oData->is_loaded_by_default === '1' ? true : false , array('id' => 'is_loaded_by_default')) . ' ' . Lang::get('menues.form.is_loaded_by_default') ) !!}
    </div>
    <div class="checkbox">
        {!! Form::_label('is_shown_print_version', Form::checkbox('is_shown_print_version', '1', isset($oData) && $oData->is_shown_print_version === '1' ? true : false , array('id' => 'is_shown_print_version')) . ' ' . Lang::get('menues.form.is_shown_print_version') ) !!}
    </div>
</div>

<div class="form-group">
    {{ Form::label('is_published', Lang::get('table_field.lists.published')) }}
    <div class="radio">
        {!! Form::_label('published_yes', Form::radio('is_published', '1', isset($oData) ? $oData->is_published === '1' : false, array('id' => 'published_yes')) . ' ' . Lang::get('table_field.lists.yes') ) !!}
    </div>
    <div class="radio">
        {!! Form::_label('published_no', Form::radio('is_published', '0', isset($oData) ? $oData->is_published === '0' : true, array('id' => 'published_no')) . ' ' . Lang::get('table_field.lists.no')) !!}
    </div>
</div>
{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}
