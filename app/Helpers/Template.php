<?php
namespace Forms;

use View;

class Template {

    /**
     * Return pre-defined array for the form
     * @param  array  $aParams list of available parameters for the form
     * 
     * @return array           pre-defined list
     */
    public static function createSimpleTemplate( $aParams = array() )
    {
        $aResult = $aParams;

        if (array_key_exists('isShownSearchBox', $aParams) === false) {
            $aResult['isShownSearchBox'] = true;
        }

        return View::make('Admin.default.components.template', array('aParams' => $aResult));
    }

    /**
     * Create a regular page
     * 
     * @param  array  $aParams list of available parameters for the form
     * 
     * @return array           pre-defined list
     */
    public static function createSiteRegularPage( $aParams = array() )
    {
        $aResult = $aParams;

        return View::make('Site.elements.page', array('aParams' => $aResult));
    }
}
