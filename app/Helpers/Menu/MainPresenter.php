<?php namespace App\Helpers\Menu;

use Pingpong\Menus\Presenters\Bootstrap\NavbarPresenter;
use Config;

 class MainPresenter extends NavbarPresenter
 {
     /**
      * {@inheritdoc }
      *
      */
     public function getOpenTagWrapper()
     {
         $class = Config::get('menus.class.wrapper.main');
         $class = $class ? $class : 'nav navbar-nav navbar-right';

         return  PHP_EOL . '<ul class="' . $class . '">' . PHP_EOL;
     }
 }
