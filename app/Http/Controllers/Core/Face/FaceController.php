<?php

namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;

use App\Http\Requests;
use Config;
use App\Http\Controllers\Core\Controller;

class FaceController extends Controller
{
    /**
     * Specify the main chapter for the Admin
     *
     * @var string
     */
    public $chapter = 'Themes';

    /**
     * Default constructor
     *
     */
    public function __construct()
    {
        $theme = Config::get('theme.' . $this->chapter . '.name');

        if ( $theme ) {
            $this->theme = $theme;
        }
    }
}
