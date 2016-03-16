@extends( $__theme . '.layouts.default')

@section('page_header')
<h1> {{ $aFormParams['formChapter'] }} <small>{{ $aFormParams['formSubChapter'] }}</small></h1>
{{ $aFormParams['sFormBreadcrumbs'] }}
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
                    {!! $aFormParams['formContent'] !!}
                </div>
                @if (isset($aFormParams['formButtons']))
                <div class="box-footer">
                    @foreach($aFormParams['formButtons'] as $item)
                    {{ Html::_button($item['type'], $item['title'], $item['params']) }}
                    @endforeach
                </div>
                @endif
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>
@stop