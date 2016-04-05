{{--
 ** Template for the NEWS details page
 **
 ** Available variables:
 **
 ** Array => news
 ****
 **** id
 **** title
 **** chapter_id
 **** content
 **** date
 **** user_id
 **** source
 **** photo
 **** url
 **** is_published
 **** is_main
 **** is_important
 **** type_news
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
                    <h1>{{ $news['source'] }}</h1>
                    <hr class="small">
                    <span class="subheading">{{ $news['title'] }}</span>
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
            {{ $news['content'] }}
        </div>
    </div>
@endsection