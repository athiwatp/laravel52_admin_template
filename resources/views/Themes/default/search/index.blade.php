{{--
    VARIABLES:
      1. №куыгде

--}}
@extends( $__theme . '.layouts.default')

{{-- Page Header --}}
@section('page_header')
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('/uploads/defaults/home-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>Search</h1>
                    <hr class="small">
                    <span class="subheading">The Search Results</span>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection

{{-- Content section --}}
@section('content')
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            @if ( $result && $result->count() > 0 )


                {{-- Pagination --}}
                @if (method_exists($result, 'links') )
                    <div class="clearfix">{!!  $result->links() !!}</div>
                @endif
            @else
                <p>No search result</p>
            @endif
        </div>
    </div>
@endsection