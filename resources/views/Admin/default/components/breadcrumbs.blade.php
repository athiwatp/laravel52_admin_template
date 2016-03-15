<ol class="breadcrumb">
    <li><a href="{{ URL::route('user-dashboard') }}"><i class="fa fa-dashboard"></i> {{ Lang::get('admin_menu.nav.main_board') }}</a></li>
    @foreach($aBreadcrumbs as $index => $item)
        @if ($item == end($aBreadcrumbs)) 
        <li class="active">{{ $item['icon'] }} {{ $item['title'] }}</li>
        @else
        <li><a href="{{ $item['url'] }}">{{ $item['icon'] }} {{ $item['title'] }} </a></li>
        @endif
    @endforeach 
</ol>