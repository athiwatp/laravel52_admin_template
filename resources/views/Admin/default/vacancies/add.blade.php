<div class="form-group">
    {{ Form::label('title', Lang::get('vacancies.form.title') ) }}
    {{ Form::text('title', ( isset($oData) ? $oData->title : null), array('class' => 'form-control convert-to-url')) }}
</div>

<div class="form-group">
    {{ Form::label('date', Lang::get('vacancies.form.date_reg')) }}
    <div class="input-group date-group">
        {{ Form::text('date_reg', ( isset($oData) ? $oData->date_reg : null), array('class' => 'form-control date-controls')) }}
        <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
        </span>
    </div>
</div>

<div class="form-group">
    {{ Form::label('valid_before', Lang::get('vacancies.form.valid_before')) }}
    <div class="input-group date-group">
        {{ Form::text('valid_before', ( isset($oData) ? $oData->valid_before : null), array('class' => 'form-control date-controls')) }}
        <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
        </span>
    </div>
</div>

<div class="form-group">
    {{ Form::label('employer', Lang::get('vacancies.form.employer') ) }}
    {{ Form::select('employer', array('0' => '--- Вибор работодателя ---'), ( isset($oData) ? $oData->employer : null), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('type_employment', Lang::get('vacancies.form.type_employment') ) }}
    {{ Form::select('type_employment', array('0' => 'Полная', 1 => 'Частичная', 2 => 'Почасовая', 3 => 'Сдельная', 4 => 'Другое'), ( isset($oData) ? $oData->type_employment : null), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('requirements', Lang::get('vacancies.form.requirements') ) }}
    {{ Form::textarea('requirements', ( isset($oData) ? $oData->requirements : null), array('class' => 'form-control ck-edtor')) }}
</div>

<div class="form-group">
    {{ Form::label('description', Lang::get('vacancies.form.description') ) }}
    {{ Form::textarea('description', ( isset($oData) ? $oData->description : null), array('class' => 'form-control ck-edtor')) }}
</div>

<div class="form-group">
    {{ Form::label('phone', Lang::get('vacancies.form.phone') ) }}
    {{ Form::text('phone', ( isset($oData) ? $oData->phone : null), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('contact_person', Lang::get('vacancies.form.contact_person') ) }}
    {{ Form::text('contact_person', ( isset($oData) ? $oData->contact_person : null), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('email', Lang::get('vacancies.form.email') ) }}
    {{ Form::text('email', ( isset($oData) ? $oData->email : null), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('wage', Lang::get('vacancies.form.wage') ) }}
    {{ Form::text('wage', ( isset($oData) ? $oData->wage : null), array('class' => 'form-control')) }}
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