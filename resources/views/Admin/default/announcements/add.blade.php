
<div class="form-group">
    {{ Form::label('title', Lang::get('announce.form.title') ) }}
    {{ Form::text('title', ( isset($oData) ? $oData->title : null), array('class' => 'form-control convert-to-url')) }}
</div>

<div class="form-group">
    {!! Form::_label('important', Form::checkbox('important', '1', isset($oData) && $oData->is_redirectable === '1' ? true : false , array('id' => 'important')) . ' ' . Lang::get('announce.form.important') ) !!}
</div>

<div class="form-group">
    {{ Form::label('date_start', Lang::get('announce.form.date_start')) }}
    <div class="input-group date-group">
        {{ Form::text('date_start', ( isset($oData) ? $oData->date_start : $date['thisDay']), array('class' => 'form-control date-controls')) }}
        <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
        </span>
    </div>
</div>

<div class="form-group">
    {{ Form::label('date_end', Lang::get('announce.form.date_end')) }}
    <div class="input-group date-group">
        {{ Form::text('date_end', ( isset($oData) ? $oData->date_end : $date['thisDayPlusMonth']), array('class' => 'form-control date-controls')) }}
        <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
        </span>
    </div>
</div>

<div class="form-group">
    {{ Form::label('description', Lang::get('announce.form.description') ) }}
    {{ Form::textarea('description', ( isset($oData) ? $oData->description : null), array('class' => 'form-control ck-edtor')) }}
</div>

<div class="form-group">
    {{ Form::label('chapter_id', Lang::get('announce.form.chapter') ) }}
    {{ Form::select('chapter_id', $aChapters, ( isset($oData) ? $oData->chapter_id : null), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('image', Lang::get('announce.form.image')) }}
    {{ Form::file('image', array() ) }}
    @if ( isset($oData) && $oData->image)
        <img src="{{ get_file_url($oData->image, 'box2') }}" title="{{ $oData->title }}" class="img-responsive img-thumbnail">
    @endif
</div>

<div class="form-group">
    {{ Form::label('is_published', Lang::get('table_field.lists.published')) }}
    <div class="radio">
        {!! Form::_label('is_published_yes', Form::radio('is_published', '1', isset($oData) ? $oData->is_published === '1' : true, array('id' => 'is_published_yes')) . ' ' . Lang::get('table_field.lists.yes') ) !!}
    </div>
    <div class="radio">
        {!! Form::_label('is_published_no', Form::radio('is_published', '0', isset($oData) ? $oData->is_published === '0' : false, array('id' => 'is_published_no')) . ' ' . Lang::get('table_field.lists.no')) !!}
    </div>
</div>

{{ Form::hidden('id', isset($oData) ? $oData->id : 0) }}