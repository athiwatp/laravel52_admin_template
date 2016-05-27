<div class="form-group">
    {{ Form::label('title', Lang::get('useful_links.form.title') ) }}
    {{ Form::text('title', ( $oData ? $oData->title : null), array('required', 'minlength' => 3, 'maxlength' => 255, 'class' => 'form-control')) }}
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
    {{ Form::textarea('description', ( $oData ? $oData->description : null), array('class' => 'form-control ck-edtor')) }}
</div>

<div class="form-group">
    {{ Form::label('image', Lang::get('useful_links.form.image')) }}
    {{ Form::file('image', array() ) }}
    @if ( isset($oData) && $oData->image)
        <br /><img src="{{ get_file_url($oData->image, 'box2') }}" title="{{ $oData->title }}" class="img-responsive img-thumbnail">
    @endif
</div>

{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}

@if( env('APP_ENV', 'testing') === 'testing' )
    {{ Form::hidden('is_active', isset($oData) ? $oData->is_active : 1) }}
@endif