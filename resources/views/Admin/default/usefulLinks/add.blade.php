<div class="form-group">
    {{ Form::label('title', Lang::get('useful_links.form.title') ) }}
    {{ Form::text('title', ( $oData ? $oData->title : null), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('url', Lang::get('useful_links.form.url') ) }}
    {{ Form::text('url', ( $oData ? $oData->url : null), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('chapter_id', Lang::get('useful_links.form.group_name') ) }}
    {{ Form::select('chapter_id', $aGroup, ( $oData ? $oData->chapter_id : null), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('description', Lang::get('useful_links.form.description') ) }}
    {{ Form::textarea('description', ( $oData ? $oData->description : null), array('class' => 'form-control')) }}
</div>

{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}