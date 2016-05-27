<?php

namespace App\Http\Controllers\Core\Admin;

use Illuminate\Http\Request;
use App\Repositories\LogsRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lang, Redirect, cTemplate, cBreadcrumbs, cForms, URL, Event, Config;

class LogsController extends AdminController
{

    /**
     * The MessageRepository instance
     *
     * @var App\Repositories\LogsRepository
     */
    protected $logs;

    /**
     * Create a new NewsController instance
     *
     * @param App\Repositories\NewsRepository
     *
     * @return void
     */
    public function __construct( LogsRepository $logs )
    {
        // injected repository instance
        $this->logs = $logs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aBreadcrumbs = array(
            array('url' => '#', 'icon' => '<i class="fa fa fa-wrench"></i>', 'title' => Lang::get('menues.nav.logs'))
        );

        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
            'sTitle' => Lang::get('logs.lists.logs'),
            'sSubTitle' => '',
            'sBoxTitle' => Lang::get('logs.lists.lists_logs'),
            'isShownSearchBox' => false,
            'sContent' => $this->renderView('logs.index', array(
                'aToolbar' => array(
                    'template' => $this->getTheme(),
                    'refresh' => array(
                        'url' => URL::route('admin.logs'),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh', 'class' => 'refresh-btn' )
                    ))
                ))
        ));
    }
}
