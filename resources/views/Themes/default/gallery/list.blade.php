{{--
    VARIABLES:
      1. $gList (Array of Objects)
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

@foreach( $gList as $gItem )
    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
        <a class="thumbnail" href="#">
            <img class="img-responsive" src="{!! get_file_url($gItem->filename,'box3') !!}" alt="{{ $gItem->title }}">
        </a>
    </div>
@endforeach

