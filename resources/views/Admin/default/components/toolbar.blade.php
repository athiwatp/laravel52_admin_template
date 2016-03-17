<div class="toolbar-controls">
    <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
    @if (isset($aToolbarParams['buttons']) && count($aToolbarParams['buttons']) > 0 )
    <div class="btn-group">
        @foreach ($aToolbarParams['buttons'] as $item)
            {!! HTML::_link( $item['url'], $item['icon'] . ' ' . $item['title'], array_merge(array(), $item['aParams'] ) ) !!}
        @endforeach
    </div>
    @endif

    @if (isset($aToolbarParams['filters']) && count($aToolbarParams['filters']) > 0)
        <div class="toolbar-filters">
            {!! Form::open(array('role' => 'form', 'url' => $aToolbarParams['filters']['url'], 'method'=>'GET', 'class' => 'toolbar-form')) !!}
                @foreach ($aToolbarParams['filters']['items'] as $name => $dropdown)
                    {!! Form::select($name, $dropdown['data'], $dropdown['selected'], array('class' => 'form-control filtrable-element')) !!}
                @endforeach
            {!! Form::close() !!}
        </div>
    @endif
</div>