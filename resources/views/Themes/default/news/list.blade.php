{{--
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
--}}
@foreach( $list as $nItem )
    <div class="post-preview">
        <a href="{{ route('news-url', ['url' => $nItem->url ]) }}">
            <h2 class="post-title">{{ $nItem->title }}</h2>
            <h3 class="post-subtitle">{{ $nItem->content }}</h3>
        </a>
        <p class="post-meta">{{ $nItem->source }}, {!! get_formatted_date( $nItem->date ) !!}</p>
    </div>
    <hr>
@endforeach