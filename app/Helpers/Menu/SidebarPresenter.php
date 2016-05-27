<?php namespace App\Helpers\Menu;

use Pingpong\Menus\Presenters\Bootstrap\NavbarPresenter;
use Pingpong\Menus\Presenters\Bootstrap\SidebarMenuPresenter;
use Config;

class SidebarPresenter extends SidebarMenuPresenter
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

    /**
     * {@inheritdoc }.
     */
    public function getMenuWithDropDownWrapper($item)
    {
        $id = str_random();

        return '
        <li class="'.$this->getActiveStateOnChild($item).' sub-menu-wrapper" id="dropdown">
            <a data-toggle="collapse" href="#'.$id.'">
                '.$item->getIcon().' '.$item->title.' <span class="caret"></span>
            </a>
            <div id="'.$id.'" class="panel-collapse collapse '.$this->getActiveStateOnChild($item, 'in').'">
                <div class="panel-body">
                    <ul class="nav navbar-nav">
                        '.$this->getChildMenuItems($item).'
                    </ul>
                </div>
            </div>
        </li>
        '.PHP_EOL;
    }
}
//dropdown open