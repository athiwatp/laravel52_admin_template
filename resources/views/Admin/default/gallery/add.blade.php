<div class="tab-content">
    <div class="form-group">
        {{ Form::label('title', Lang::get('gallery.form.title') ) }}
        {{ Form::text('title', ( isset($oData) ? $oData->title : null), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('description', Lang::get('table_field.lists.descriptions') ) }}
        {{ Form::textarea('description', ( isset($oData) ? $oData->description: null), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('chapter', Lang::get('gallery.form.chapter') ) }}
        {{ Form::select('chapter', $aChapter, ( isset($oData) ? $oData->chapter_id : null), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('type', Lang::get('gallery.form.type') ) }}
        {{ Form::select('type', $sType, ( isset($oData) ? $oData->tp : null), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('pos', Lang::get('table_field.lists.pos') ) }}
        {{ Form::number('pos', ( isset($oData) ? $oData->pos : null), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
    {{ Form::label('file', Lang::get('gallery.form.file')) }}
    {{ Form::file('file', array() ) }}
</div>
{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}
</div>