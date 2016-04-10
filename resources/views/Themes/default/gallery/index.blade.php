{{--
    VARIABLES:
      1. gallery (Array of Objects)
         **** id
         **** title
         **** chapter_id
         **** filename
         **** tp
         **** user_id
         **** pos
         **** created_at
         **** updated_at
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
                    <h1>Gallery</h1>
                    <hr class="small">
                    <span class="subheading">Gallery Items</span>
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
            <div class="row">
            @foreach( $gallery as $gItem )
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="{!! get_file_url($gItem->filename,'box3') !!}" alt="{{ $gItem->title }}">
                    </a>
                </div>
            @endforeach

            {{-- Pagination --}}
            @if (method_exists($gallery, 'links') )
                <div class="clearfix">{!!  $gallery->links() !!}</div>
            @endif
            </div>
        </div>
    </div>
@endsection