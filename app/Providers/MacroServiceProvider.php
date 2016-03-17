<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Html, Form;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Html::macro('_link', function($sUrl, $sTitle, $aParams = array())
        {
            return str_replace('%LINK%', $sTitle, Html::link($sUrl, '%LINK%', $aParams) );
        });

        Form::macro('_label', function($name, $value = null, $options = array())
        {
            $label = Form::label($name, '%s', $options);

            return sprintf($label, $value);
        });

        Html::macro('_button', function($sType, $sTitle, $aParams) {
            $aParameters = array('class' => 'btn');

            foreach($aParams as $key => $param) {
                if ( array_key_exists($key, $aParameters) ) {
                    $aParameters[$key] .= ' ' . $param;
                } else {
                    $aParameters[$key] = $param;
                }
            }

            if ( $sType === 'submit' ) {
                return Form::submit($sTitle, $aParameters);
            } else
            if ( $sType === 'link' ) {
                $sUrl =  '#';

                if (isset($aParameters['url']) && $aParameters['url']) {
                    $sUrl = $aParameters['url'];

                    unset($aParameters['url']);
                }

                return Html::_link($sUrl, $sTitle, $aParameters);
            }
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
