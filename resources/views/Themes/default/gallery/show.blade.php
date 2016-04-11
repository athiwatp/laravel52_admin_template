{{--
 ** Template for the Gallery details page
 **
 ** Available variables:
 **
 ** Object => gallery
 ****
 **** id
 **** title
 **** chapter_id
 **** filename
 **** tp
 **** user_id
 **** pos
 **** created_at
 **** updated_at
 ****
 ****
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
                    <h1>{{ $gallery->title }}</h1>
                    <hr class="small">
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
            {{ $gallery->description }}
        </div>
    </div>
@endsection