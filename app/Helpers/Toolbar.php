<?php 

namespace Toolbar;

class Items {

    /**
     * Return pre-defined array for the toolbar
     * @param  array  $aButtons list of available buttons with the links
     * @return array           pre-defined list
     */
    public static function getToolbarParams( $aButtons = array(), $aFilters = array() )
    {

        $sDefaultClass = 'btn btn-default btn-sm';
        $aResult = array(
            'buttons' => array(),
            'filters' => $aFilters
        );

        if (array_key_exists('template', $aButtons)) {
            $aTemplate = $aButtons['template'];
        }

        if (array_key_exists('add', $aButtons)) {
            $aResult['buttons'][] = $aButtons['add'];
        }
        
        if (array_key_exists('edit', $aButtons)) {
            $aResult['buttons'][] = $aButtons['edit'];
        }

        if (array_key_exists('delete', $aButtons)) {
            $aResult['buttons'][] = $aButtons['delete'];
        }

        if (array_key_exists('sync', $aButtons)) {
            $aResult['buttons'][] = $aButtons['sync'];
        }

        if (array_key_exists('custom', $aButtons)) {
            $aResult['buttons'][] = $aButtons['custom'];
        }

        if (array_key_exists('refresh', $aButtons)) {
            $aResult['buttons'][] = $aButtons['refresh'];
        }

        foreach($aResult['buttons'] as $index => $button) {
            if ( array_key_exists('aParams', $button) && array_key_exists('class', $button['aParams']) ) {
                $aResult['buttons'][$index]['aParams']['class'] = $sDefaultClass . ' ' . $button['aParams']['class'];
            } else {
                $aResult['buttons'][$index]['aParams']['class'] = $sDefaultClass;
            }
        }
    
        return view($aTemplate . '.components.toolbar', array('aToolbarParams' => $aResult));
    }
}