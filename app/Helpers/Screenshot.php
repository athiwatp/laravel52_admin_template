<?php 

namespace Screenshot;

class Items {

    /**
     * 
     * @param  array
     * @return string
     */
    public static function getItems( $sUrl, $aItems = array() )
    {
        if ($sUrl) {
            $parsed_url = parse_url($sUrl);
            parse_str($parsed_url['query'], $parsed_query);

            return $parsed_query['v'];
        }

        return '';
    }
}