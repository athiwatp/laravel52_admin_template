<?php 

namespace Breadcrumb;

use View;

class Items {

    /**
     * Return pre-defined list of the breadcrumbs
     * @param  array  $aItems list of available items for the breadcrumb
     * @return array           pre-defined list
     */
    public static function getItems( $aItems = array() )
    {
        
        $aBreadcrumbItems = $aItems;

        return View::make('Admin.default.components.breadcrumbs', array('aBreadcrumbs' => $aBreadcrumbItems));
    }
}