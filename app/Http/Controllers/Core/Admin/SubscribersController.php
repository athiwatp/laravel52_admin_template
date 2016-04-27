<?php

namespace App\Http\Controllers\Core\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\SubscribersRequests;
use App\Repositories\SubscribersRepository;
use App\Http\Controllers\Controller;
use Lang, Redirect, cTemplate, cBreadcrumbs, cForms, URL, Config;

class SubscribersController extends AdminController
{
        /**
     * The MessageRepository instance
     *
     * @var App\Repositories\SubscribersRepository
     */
    protected $subscribers;

    /**
     * Create a new SubscribersRepository instance
     *
     * @param App\Repositories\SubscribersRepository
     *
     * @return void
     */
    public function __construct( SubscribersRepository $subscribers )
    {
        $this->subscribers = $subscribers;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aBreadcrumbs = array(
            array('url' => '#', 'icon' => '<i class="fa fa-rss"></i>', 'title' => Lang::get('subscribers.lists.lists_subscribers'))
        );

        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
            'sTitle' => Lang::get('subscribers.lists.subscribers_management'),
            'sSubTitle' => Lang::get('subscribers.lists.subscribers_management_online'),
            'sBoxTitle' => Lang::get('subscribers.lists.lists_subscribers'),
            'isShownSearchBox' => false,
            'sContent' => $this->renderView('subscribers.index', array(
                'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
                'aToolbar' => array(
                    'template' => $this->getTheme(),
                    'add' => array(
                        'url' => URL::route('admin.subscribers.create'),
                        'title' => Lang::get('table_field.toolbar.add'),
                        'icon' => '<i class="fa fa-plus"></i>',
                        'aParams' => array('id' => 'add')
                    ),
                    'edit' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.edit'),
                        'icon' => '<i class="fa fa-pencil"></i>',
                        'aParams' => array('id' => 'edit', 'disabled' => true, 'class' => 'edit-btn', 'data-url' => URL::route('admin.subscribers.edit', array('id' => '%id%')) )
                    ),
                    'delete' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'aParams' => array('id' => 'delete', 'disabled' => true, 'class' => 'delete-btn', 'data-url' => URL::route('admin.subscribers.destroy', array('id' => '%id%')) )
                    ),
                    'refresh' => array(
                        'url' => URL::route('admin.subscribers.index'),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh', 'class' => 'refresh-btn', 'data-url' => URL::route('admin.subscribers.index') )
                    )
                )
            ))
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aBreadcrumbs = array(
            array('url' => URL::route('admin.subscribers.index'), 'icon' => '<i class="fa fa-list-alt"></i>', 'title' => Lang::get('subscribers.lists.lists_subscribers')),
            array('url' => '#', 'icon' => '<i class="fa fa-rss"></i>', 'title' => Lang::get('subscribers.lists.create_subscribers'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('subscribers.lists.subscribers_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('subscribers.lists.create_subscribers'),
            'useCKEditor' => true,
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.subscribers.index'), 'class'=>'btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-success')
                )
            ),
            'formSwitcher' => array(
                array(
                    'title' => Lang::get('subscribers.form.active'),
                    'name' => 'is_active'
                )
            ),
            'formContent' => $this->renderView('subscribers.add', array(
                'oData' => null
            )),
            'formUrl' => URL::route('admin.subscribers.store'),
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->subscribers->store( $request->all() );

        return Redirect::route('admin.subscribers.index')
            ->with('message', array(
                'code'      => self::$statusOk,
                'message'   => Lang::get('subscribers.lists.subscribers_saved_successfully') ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aBreadcrumbs = array(
            array('url' => URL::route('admin.subscribers.index'), 'icon' => '<i class="fa fa-rss"></i>', 'title' => Lang::get('subscribers.lists.lists_subscribers')),
            array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('subscribers.lists.editing_subscribers'))
        );
        $oData = $this->subscribers->edit($id);

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('subscribers.lists.subscribers_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('subscribers.lists.editing_subscribers'),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.subscribers.index'), 'class'=>'btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-success')
                )
            ),
            'formSwitcher' => array(
                array(
                    'title' => Lang::get('subscribers.form.active'),
                    'name' => 'is_active',
                    'value' => $oData->is_active
                )
            ),
            'formContent' => $this->renderView('subscribers.add', array(
                'oData' => $oData
            )),
            'formUrl' => URL::route('admin.subscribers.store'),
        ));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
