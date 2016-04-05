@extends( $__theme . '.layouts.default')

{{-- Page Header --}}
@section('page_header')
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('/uploads/defaults/home-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>Веб-мастер</h1>
                    <hr class="small">
                    <span class="subheading">Тема для Веб-сайта</span>
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

            @foreach( $lNews as $item )
                <div class="post-preview">
                    <a href="{{ route('news-url', ['url' => $item['url'] ]) }}">
                        <h2 class="post-title">{{ $item['title'] }}</h2>
                        <h3 class="post-subtitle">{{ $item['content'] }}</h3>
                    </a>
                    <p class="post-meta">{{ $item['source'] }}, {{ $item['date'] }}</p>
                </div>
                <hr>
            @endforeach


            <!-- Pager -->
            <ul class="pager">
                <li class="next">
                    <a href="#">Еще &rarr;</a>
                </li>
            </ul>
        </div>
    </div>
@endsection