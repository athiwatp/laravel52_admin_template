{{--
    VARIABLES:
      1. lNews (Array of Objects)
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

      2. currPage (Object)
          id
          title
          subtitle
          url
          meta_keywords
          meta_descriptions
          content
          is_published
          user_id
          created_at
          updated_at

      3. lGallery (Object) - list of photos
        **** id
         **** title
         **** chapter_id
         **** filename
         **** tp
         **** user_id
         **** pos
         **** created_at
         **** updated_at

      4. $lImportantAnnounces,
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

      5. $lRegularAnnounces
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
                    <h1>{{ $currPage->title }}</h1>
                    <hr class="small">
                    <span class="subheading">{{ $currPage->subtitle }}</span>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection

{{-- Content section --}}
@section('content')
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">{{ $currPage->content }}</div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <h1>Important Announces</h1>
            {{-- Retrieve the list --}}
            <div class="row">
                @include('Themes.default.announces.list.important', ['aImportantList' => $lImportantAnnounces])
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <h1>News</h1>
            {{-- The list of news --}}
            @include('Themes.default.news.list', [ 'list' => $lNews ])

            <!-- Pager -->
            <ul class="pager">
                <li class="next">
                    <a href="#">Еще &rarr;</a>
                </li>
            </ul>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <h1>Upcomming Announces</h1>
            {{-- Retrieve the list --}}
            <div class="row">
                @include('Themes.default.announces.list.upcomming', ['aList' => $lRegularAnnounces])
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <h1>Photo</h1>
            {{-- Retrieve the list --}}
            <div class="row">
            @include('Themes.default.gallery.list', ['gList' => $lGallery])
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <h1>Video</h1>
            {{-- Retrieve the list --}}
            <div class="row">
                @include('Themes.default.video.list', ['vList' => $lVideo])
            </div>
        </div>
    </div>
@endsection