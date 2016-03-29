<?php namespace TrackChangesUrl;

use App\Models\UrlHistory;
use Carbon\Carbon;

class Items {


    public static function getItems( $aParams = array() ) {
        $aData      = isset($aParams['aData']) ? $aParams['aData'] : array();
        $sType      = isset($aData['content_type']) ? $aData['content_type'] : '';
        $sUrl       = isset($aData['url']) ? $aData['url'] : '';
        $sContentId = isset($aData['type_id']) ? $aData['type_id'] : '';

        $historyUrl = UrlHistory::where('type', '=', $sType)
            ->where('type_id', '=', $sContentId)
            ->where('url', '=', $sUrl)
            ->first();

        if ( $historyUrl === null ) {
            $history = new UrlHistory;

            $history->type_id   = $sContentId;
            $history->url       = $sUrl;
            $history->type      = $sType;
            $history->add_date  = Carbon::now()->toDateString();

            $history->save();
        }

        return true;
    }
}