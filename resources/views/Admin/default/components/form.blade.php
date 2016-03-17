@extends( $__theme . '.layouts.default')

@section('page_header')
<h1> {{ $aFormParams['formChapter'] }} <small>{{ $aFormParams['formSubChapter'] }}</small></h1>
{!! $aFormParams['sFormBreadcrumbs'] !!}
@stop

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $aFormParams['formTitle'] }}</h3>
                </div>
                {{ Form::open(array('role' => 'form', 'url' => $aFormParams['formUrl'], 'method'=>'POST', 'files'=>true, 'encrypt'=>'multipart/form-data', 'class' => (isset($aFormParams['formClass']) ? $aFormParams['formClass'] : '') )) }}
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
</section>
@stop