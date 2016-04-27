@extends( $__theme . '.layouts.fileuploader')

@section('content')
    @if ( Session::has('message') )
        <?php
        $aMessage = Session::get('message');
        $sType    = 'alert alert-warning alert-dismissable';

        if ( is_array($aMessage) ) {
            $sType    = $aMessage['code'];
            $sMessage = $aMessage['message'];
        } else {
            $sMessage = $aMessage;
        }
        ?>
        <div class="{{$sType}}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ $sMessage }}
        </div>
    @endif

    <div class="box image-preview">
        @include( $__theme . '.files.box-item', array(
            'item' => $oFile,
            'sClassName' => 'fullWidthFileDiv',
            'sImageDivClassName' => 'fullWidthimgDiv',
            'sFileImgClass' => 'fullWidthfileImg',
            'iHeight' => $iHeight
        ))
    </div>
@stop