<div class="form-group">
    {{ Form::label('title', Lang::get('gallery.form.title') ) }}
    {{ Form::text('title', ( isset($oData) ? $oData->title : null), array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('description', Lang::get('table_field.lists.descriptions') ) }}
    {{ Form::textarea('description', ( isset($oData) ? $oData->description: null), array('class' => 'form-control ck-edtor')) }}
</div>
<div class="form-group">
    {{ Form::label('chapter', Lang::get('gallery.form.chapter') ) }}
    {{ Form::select('chapter', $aChapter, ( isset($oData) ? $oData->chapter_id : null), array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('pos', Lang::get('table_field.lists.pos') ) }}
    {{ Form::number('pos', ( isset($oData) ? $oData->pos : null), array('class' => 'form-control data-pos')) }}
</div>
<div class="form-group">
    {{ Form::label('filename', Lang::get('gallery.form.file')) }}
    {{ Form::file('filename', array() ) }}
    @if ( isset($oData) && $oData->filename)
        <br /><img src="{{ get_file_url($oData->filename, 'box2') }}" title="{{ $oData->title }}" class="img-responsive img-thumbnail">
    @endif
</div>
{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}