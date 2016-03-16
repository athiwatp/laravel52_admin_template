@extends( $__theme . '.layouts.default')

{{-- Title section --}}
@section('site-title')
{{ isset($aParams['sTitle']) ? '| ' . $aParams['sTitle'] : ''}} {{ isset($aParams['sSubTitle']) ? ': ' . $aParams['sSubTitle'] : '' }}
@stop

{{-- Header section --}}
@section('page_header')
    <h1> {{ $aParams['sTitle'] }} <small>{{ $aParams['sSubTitle'] }}</small></h1>
    @if( isset($aParams['sBreadcrumbs']) && $aParams['sBreadcrumbs'] !== null )
    {!! $aParams['sBreadcrumbs'] !!}
    @endif
@stop

{{-- Content section --}}
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            
            <div class="box-header">
                @if (isset($aParams['sBoxTitle']))
                <h3 class="box-title">{{ $aParams['sBoxTitle'] }}</h3>
                @endif
                <div class="box-tools">
                    @if( $aParams['isShownSearchBox'] === true )
                    <div class="input-group" style="width: 150px;">
                        {{ Form::open(array('method'=>'GET', 'class' => 'input-group') ) }}
                        {{ Form::text('keywords', 'keywords', array('class' => 'form-control input-sm pull-right search-control', 'placeholder' => Lang::get('admin_page.form.search') ) ) }}
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                        {{ Form::close() }}
                    </div>
                    @endif
                </div>
            </div><!-- /.box-header -->
            
            <div class="box-body table-responsive no-padding">{{ (isset($aParams['sContent']) ? $aParams['sContent'] : '') }}</div>

        </div><!-- /.box -->
    </div><!-- /.col-xs-12 -->
</div><!-- /.row -->            
@stop