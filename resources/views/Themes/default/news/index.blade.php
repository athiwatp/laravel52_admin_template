{{--
    VARIABLES:
      1. news (Array of Objects)
        id
        title
        chapter_id
        content
        date
        user_id
        source
        photo
        url
        is_published
        is_main
        is_important
        type_news
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
                    <h1>News</h1>
                    <hr class="small">
                    <span class="subheading">The Latest News</span>
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
            {{-- The list of news --}}
            @include('Themes.default.news.list', [ 'list' => $lNews ])

            {{-- Pagination --}}
            @if (method_exists($lNews, 'links') )
                <div class="clearfix">{!!  $lNews->links() !!}</div>
            @endif
        </div>
    </div>
@endsection