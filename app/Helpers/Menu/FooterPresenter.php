<?php namespace App\Helpers\Menu;

use Pingpong\Menus\Presenters\Bootstrap\NavbarPresenter;
use Config;

class FooterPresenter extends NavbarPresenter
{
    /**
     * {@inheritdoc }
     *
     */
    public function getOpenTagWrapper()
    {
        $class = Config::get('menus.class.wrapper.footer');
        $class = $class ? $class : 'nav';

        return  PHP_EOL . '<ul class="' . $class . '">' . PHP_EOL;
    }
}
