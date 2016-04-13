{{--
     $announce => an Object with the follwoing fields

     **** id
     **** title
     **** description
     **** important
     **** date_start
     **** date_end
     **** chapter_id
     **** user_id
     **** image
     **** is_published
     **** created_at
     **** updated_at

     **** chapter  <=== Object which represents the App\Models\Chapters
     ******** id
     ******** title
     ******** description
     ******** parent_id
     ******** path
     ******** pos
     ******** is_active
     ******** type_chapter
     ******** date
     ******** number
     ******** user_id
     ******** icon
     ******** created_at
     ******** updated_at
--}}
@extends( $__theme . '.layouts.default')

{{-- Page Header --}}
@section('page_header')
        <!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('/uploads/defaults/home-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="page-heading">
                    <h1>{{ $announce->title }}</h1>
                    <hr class="small">
                    <span class="subheading">{!! get_formatted_date( $announce->date_start ) . ' - ' . get_formatted_date( $announce->date_end ) !!}</span>
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
            <h2>{{ $announce->title }}</h2>
            @if ( $announce->chapter )
            <p><i>{{ $announce->chapter->title }}</i></p>
            @endif
            <div>{!! $announce->description !!}</div>
        </div>
    </div>
@endsection
