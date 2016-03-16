<?php 

namespace Breadcrumb;

class Items {

    /**
     * Return pre-defined list of the breadcrumbs
     * @param  array  $aItems list of available items for the breadcrumb
     * @return array           pre-defined list
     */
    public static function getItems( $aTemplate, $aItems = array() )
    {
        $aBreadcrumbItems = $aItems;

        return view( $aTemplate . '.components.breadcrumbs', array('aBreadcrumbs' => $aBreadcrumbItems));
    }
}