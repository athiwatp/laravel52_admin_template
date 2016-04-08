{{--
 ** Template for the NEWS details page
 **
 ** Available variables:
 **
 ** Object => page
 ****
 **** "id": 1
 **** "title": "sssd "
 **** "url": "sssd"
 **** "meta_keywords": ""
 **** "meta_descriptions": ""
 **** "content": "sddssd"
 **** "is_published": "1"
 **** "user_id": 1
 **** "created_at": "2016-03-22 21:21:48"
 **** "updated_at": "2016-03-27 10:27:02"
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
                    <h1>{{ $page->title }}</h1>
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
            {{ $page->content }}
        </div>
    </div>
@endsection