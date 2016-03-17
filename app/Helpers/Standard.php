<?php

namespace Forms;

class Standard {

    /**
     * Return pre-defined array for the form
     * @param  array  $aParams list of available parameters for the form
     * @return array           pre-defined list
     */
    public static function createForm( $aTemplate, $aParams = array() )
    {
        $aResult = $aParams;

        return view( $aTemplate . '.components.form', array( '__theme' => $aTemplate, 'aFormParams' => $aResult ));
    }
}