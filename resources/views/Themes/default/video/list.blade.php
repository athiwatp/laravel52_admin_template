{{--
    **** id
    **** title
    **** content
    **** date
    **** user_id
    **** url
    **** is_published
    **** created_at
    **** updated_at
 --}}
@foreach( $vList as $vItem )
    <div class="post-preview">
        <a href="{{ route('video-url', ['id' => $vItem->id ]) }}">
            <h2 class="post-title">{{ $vItem->title }}</h2>
            <h3 class="post-subtitle">{{ $vItem->content }}</h3>
            <img width="100" height="50" src="{!! get_youtube_preview($vItem->url) !!}" class="img-responsive img-thumbnail">
        </a>
        <p class="post-meta">{!! get_formatted_date( $vItem->date ) !!}</p>
    </div>
    <hr>
@endforeach