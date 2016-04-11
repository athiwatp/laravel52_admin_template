{{--
    VARIABLES:
      1. $lVideo (Array of Objects)
        id
        title
        content
        date
        user_id
        url
        is_published
        created_at
        updated_at

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
                    <h1>Video</h1>
                    <hr class="small">
                    <span class="subheading">The Latest Video</span>
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
            @if ( $lVideo && $lVideo->count() > 0 )

                {{-- The list of news --}}
                @include('Themes.default.video.list', [ 'vList' => $lVideo ])

                {{-- Pagination --}}
                @if (method_exists($lVideo, 'links') )
                    <div class="clearfix">{!!  $lVideo->links() !!}</div>
                @endif
            @else
                <p>No video found</p>
            @endif
        </div>
    </div>
@endsection