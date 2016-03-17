<?php

namespace Forms;

class Template {

    /**
     * Return pre-defined array for the form
     * @param  array  $aParams list of available parameters for the form
     * 
     * @return array           pre-defined list
     */
    public static function createSimpleTemplate( $aTemplate, $aParams = array() )
    {
        $aResult = $aParams;

        if (array_key_exists('isShownSearchBox', $aParams) === false) {
            $aResult['isShownSearchBox'] = true;
        }

        return view( $aTemplate . '.components.template', array( '__theme' => $aTemplate ,'aParams' => $aResult ) );
    }

    /**
     * Create a regular page
     * 
     * @param  array  $aParams list of available parameters for the form
     * 
     * @return array           pre-defined list
     */
    public static function createSiteRegularPage( $aTemplate, $aParams = array() )
    {
        $aResult = $aParams;

        return view( $aTemplate . 'components.page', array( '__theme' => $aTemplate , 'aParams' => $aResult ));
    }
}
