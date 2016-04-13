{{--
     $aImportantList => Array of Objects

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
@if ( isset($aImportantList) && $aImportantList )
    @foreach( $aImportantList as $aItem )
        <div class="post-preview">
            <a href="{{ route('announce-show', ['id' => $aItem->id ]) }}">
                <h2 class="post-title">{{ $aItem->title }}</h2>
                <h3 class="post-subtitle">{!! $aItem->description !!}</h3>
            </a>
            <p class="post-meta">{!! get_formatted_date( $aItem->date_start ) !!} - {!! get_formatted_date( $aItem->date_end ) !!}</p>
        </div>
        <hr>
    @endforeach
@endif