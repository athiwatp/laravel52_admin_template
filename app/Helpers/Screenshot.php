<?php 

namespace Screenshot;

class Items {

    /**
     * Return pre-defined list of the breadcrumbs
     * @param  array  $aItems list of available items for the breadcrumb
     * @return array           pre-defined list
     */
    public static function getItems( $sUrl, $aItems = array() )
    {
        $parsed_url = parse_url($sUrl);
        parse_str($parsed_url['query'], $parsed_query);

    // $parsed_query['v']

        return $parsed_query['v'];
    }
}