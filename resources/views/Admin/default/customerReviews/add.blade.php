<div class="form-group">
    {{ Form::label('title', Lang::get('customer_reviews.form.title') ) }}
    {{ Form::text('title', ( isset($oData) ? $oData->title : null), array('class' => 'form-control convert-to-url')) }}
</div>

<div class="form-group">
    {{ Form::label('date', Lang::get('table_field.lists.date')) }}
    <div class="input-group date-group">
        {{ Form::text('date', ( isset($oData) ? $oData->date : null), array('class' => 'form-control date-controls')) }}
        <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
        </span>
    </div>
</div>

<div class="form-group">
    {{ Form::label('comment', Lang::get('customer_reviews.form.comment') ) }}
    {{ Form::textarea('comment', ( isset($oData) ? $oData->comment : null), array('class' => 'form-control ck-edtor')) }}
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