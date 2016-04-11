<?php namespace App\Helpers\Menu;

use Pingpong\Menus\Presenters\Bootstrap\NavbarPresenter;
use Config;

class SidebarPresenter extends NavbarPresenter
{
    /**
     * {@inheritdoc }
     *
     */
    public function getOpenTagWrapper()
    {
        $class = Config::get('menus.class.wrapper.sidebar');
        $class = $class ? $class : 'nav navbar-nav navbar-left';

        return  PHP_EOL . '<ul class="' . $class . '">' . PHP_EOL;
    }
}
