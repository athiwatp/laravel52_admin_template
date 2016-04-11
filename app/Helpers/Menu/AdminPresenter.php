<?php namespace App\Helpers\Menu;

use Pingpong\Menus\Presenters\Bootstrap\NavbarPresenter;

class AdminPresenter extends NavbarPresenter
{
    /**
     * {@inheritdoc }
     */
    public function getOpenTagWrapper()
    {
        return  PHP_EOL . '<ul class="nav" id="side-menu">' . PHP_EOL;
    }

    /**
     * {@inheritdoc }
     */
    public function getMenuWithDropDownWrapper($item)
    {
        return '<li>'
        .  '<a href="#">'.$item->getIcon().' ' . $item->title . '</a>'
        .  '<ul class="nav nav-second-level"> '
        .   $this->getChildMenuItems($item) . ' '
        .  '</ul>'
        . '</li>'
        . PHP_EOL;
        ;
    }

    public function getActiveState($item, $state = ' class="active"')
    {
        return \Request::is($item->getRequest()) ? ' class=\'active\'' : null;
    }

    public function getActiveStateOnChild($item, $state = 'active')
    {
        $hasActiveOnChild = false;

        if ($item->hasChilds()) {
            foreach($item->getChilds() as $child)
            {
                $hasActiveOnChild = Request::is($child->getRequest()) ? true : false;
                if ($hasActiveOnChild === true) {
                    break;
                }
            }
        }
        return $hasActiveOnChild ? $state : null;
    }
}