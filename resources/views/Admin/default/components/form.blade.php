{{--
 $aFormParams - array of options
    - formJsHandler - Vue handler for the form, placed in resources/assets/js/Admin/modules/<MODULE_NAME>/form.js
--}}
@extends( $__theme . '.layouts.default')


@section('javascript')
    @if ( array_key_exists('useCKEditor', $aFormParams) && $aFormParams['useCKEditor'] )
    {!! Html::script('js/vendor/ckeditor/ckeditor.min.js') !!}
    @endif
@stop

@section('page_header')
<h1> {{ $aFormParams['formChapter'] }} <small>{{ $aFormParams['formSubChapter'] }}</small></h1>
{!! $aFormParams['sFormBreadcrumbs'] !!}
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $aFormParams['formTitle'] }}</h3>
            </div>
            {{
                Form::open(array(
                    'role' => 'form',
                    'url' => $aFormParams['formUrl'],
                    'method'=>'POST',
                    'files'=>true,
                    'encrypt'=>'multipart/form-data',
                    'class' => 'admin-vue-form ' . (array_key_exists('formClass', $aFormParams) ? $aFormParams['formClass'] : ''),
                    'data-handler' => ( array_key_exists('formJsHandler', $aFormParams) ? $aFormParams['formJsHandler'] : '' ),
                    'id' => ( array_key_exists('formFormId', $aFormParams) ? $aFormParams['formFormId'] : 'auto-generated' ),
                ))
            }}
            <div class="box-body">
                @if ( isset($errors) && $errors->all() )
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> {{ Lang::get('admin_page.form.attention') }}</h4>
                    {{ Lang::get('admin_page.form.save_issue') }}
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                {!! $aFormParams['formContent'] !!}
            </div>
            @if (isset($aFormParams['formSwitcher']))
            @foreach($aFormParams['formSwitcher'] as $item)
            <div class="form-group">
                {{ Form::label('active', $item['title']) }}
                <div class="switcher">
                    <my-switcher
                        cmp-yes = "{{ Lang::get('table_field.lists.yes') }}"
                        cmp-no = "{{ Lang::get('table_field.lists.no') }}"
                        cmp-value = "{{ isset($item['value']) ? $item['value'] : '1' }}"
                        cmp-name = "{{ $item['name'] }}">
                    </my-switcher>
                </div>
            </div>
            @endforeach
            @endif
            <br>
            @if (isset($aFormParams['formButtons']))
            <div class="box-footer">
                @foreach($aFormParams['formButtons'] as $item)
                {!! Html::_button($item['type'], $item['title'], $item['params']) !!}
                @endforeach
            </div>
            @endif
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop