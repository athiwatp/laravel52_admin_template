<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Define the CHAPTER
     *
     * @var string
     */
    public $chapter = 'Themes';

    /**
     * Theme for the application
     *
     * @var string
    */
    public $theme = 'default';

    /**
     * Returns theme path
     *
     * @return string - theme path
    */
    public function getTheme()
    {
        return $this->chapter . '.' . $this->theme;
    }

    /**
     * Returns the full path to the template
     *
     * @param string $sTemplate - the template name
     *
     * @return string
    */
    public function getTemplate( $sTemplate )
    {
        $sTheme = $this->getTheme();

        return $sTheme . '.' . $sTemplate;
    }

    /**
     * Renders the template
     *
     * @param string $sView - name
     * @param array $aParams - the view params
     *
     * @return string
    */
    public function renderView( $sView, $aParams = array() )
    {
        if ( isset($aParams['__theme']) === false ) {
            $aParams['__theme'] = $this->getTheme();
        }

        return view( $this->getTemplate( $sView ), $aParams );
    }
}
