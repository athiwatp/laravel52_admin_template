<div class="form-group">
    {{ Form::label('title', Lang::get('chapters.form.title') ) }}
    {{ Form::text('title', ( isset($oData) ? $oData->title : null), array('required', 'minlength' => 3, 'maxlength' => 255, 'class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('description', Lang::get('chapters.form.description') ) }}
    {{ Form::textarea('description', ( isset($oData) ? $oData->description : null), array('class' => 'form-control ck-edtor')) }}
</div>
<div class="form-group">
    {{ Form::label('pos', Lang::get('chapters.form.pos') ) }}
    {{ Form::number('pos', ( isset($oData) ? $oData->pos : null), array('class' => 'form-control data-pos')) }}
</div>
<div class="form-group">
    {{ Form::label('icon', Lang::get('chapters.form.icon')) }}
    {{ Form::file('icon', array() ) }}
    @if ( isset($oData) && $oData->icon)
        <img src="{{ get_file_url($oData->icon, 'box2') }}" title="{{ $oData->title }}" class="img-responsive img-thumbnail">
    @endif
</div>
{{ Form::hidden('sType', isset($oData) ? $oData->type_chapter : $sType) }}
{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}

@if( env('APP_ENV', 'testing') )
    {{ Form::hidden('is_active', isset($oData) ? $oData->is_active : 1) }}
@endif