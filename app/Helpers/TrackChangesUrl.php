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

            if ( $history->save() ) {
                return $history;
            }
        }

        return false;
    }

    public static function addUrl( $aParams = array() )
    {
        $iUrl   = isset($aParams['content_url']) ? $aParams['content_url'] : '';
        $aTitle = isset($aParams['content_title']) ? $aParams['content_title'] : '';

        $converter = array('А' => 'A', 'а' => 'a', 'Б' => 'B', 'б' => 'b', 'В' => 'V', 'в' => 'v', 'Г' => 'G', 'г' => 'g', 'Д' => 'D', 'д' => 'd',
            'Е' => 'E', 'е' => 'e', 'Ё' => 'Yo', 'ё' => 'yo', 'Ж' => 'Zh', 'ж' => 'zh', 'З' => 'Z', 'з' => 'z', 'И' => 'I', 'и' => 'i', 'Й' => 'Y',
            'й' => 'y', 'К' => 'K', 'к' => 'k', 'Л' => 'L', 'л' => 'l', 'М' => 'M', 'м' => 'm', 'Н' => 'N', 'н' => 'n', 'О' => 'O', 'о' => 'o',
            'П' => 'P', 'п' => 'p', 'Р' => 'R', 'р' => 'r', 'С' => 'S', 'с' => 's', 'Т' => 'T', 'т' => 't', 'У' => 'U', 'у' => 'u', 'Ф' => 'F',
            'ф' => 'f', 'Х' => 'Kh', 'х' => 'kh', 'Ц' => 'Ts', 'ц' => 'ts', 'Ч' => 'Ch', 'ч' => 'ch', 'Ш' => 'Sh', 'ш' => 'sh', 'Щ' => 'Sch', 'щ' => 'sch',
            'Ъ' => '', 'ъ' => '', 'Ы' => 'Y', 'ы' => 'y', 'Ь' => '', 'ь' => '', 'Э' => 'E', 'э' => 'e', 'Ю' => 'Yu', 'ю' => 'yu', 'Я' => 'Ya', 'я' => 'ya',
            'ї' => 'i', 'Ї' => 'I', 'і' => 'i', 'І' => 'I', ' ' => '_', ',' => '', '.' => '', ';' => '', ':' => '', '!' => '-', '?' => '-', '@' => '-', '#' => '-', '%' => '-',
            '&' => '-', '*' => '-', '(' => '-', ')' => '-', '=' => '-', '+' => '-', '/' => '-', '{' => '', '}' => '', '\'' => '', '"' => '', '<' => '',
            '>' => '', '»' => '', '«' => '');

        $iUrl = strtolower(strtr($aTitle, $converter));

        return json_decode(json_encode(array(
            'url' => $iUrl
        )));
    }
}