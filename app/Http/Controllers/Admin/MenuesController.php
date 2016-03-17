<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MenuesRequest;
use App\Repositories\MenuesRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lang, Redirect, cTemplate, cBreadcrumbs, cForms, URL;

class MenuesController extends AdminController
{
    /**
     * The MessageRepository instance
     *
     * @var App\Repositories\MenuesRepository
     */
    protected $menues;

    /**
     * Create a new MenuesController instance
     *
     * @param App\Repositories\MenuesRepository
     *
     * @return void
     */
    public function __construct( MenuesRepository $menues )
    {
        $this->menues = $menues;

        $this->middleware('guest');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aBreadcrumbs = array(
            array('url' => '#', 'icon' => '<i class="fa fa-bars"></i>', 'title' => Lang::get('menues.lists.lists_menues'))
        );

        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
            'sTitle' => Lang::get('menues.nav.menu_management'),
            'sSubTitle' => Lang::get('menues.lists.menues_online'),
            'sBoxTitle' => Lang::get('menues.lists.lists_menues'),
            'isShownSearchBox' => false,
            'sContent' => $this->renderView('menues.index', array(
                'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
                'aToolbar' => array(
                    'template' => $this->getTheme(),
                    'add' => array(
                        'url' => URL::route('admin.menu.create'),
                        'title' => Lang::get('table_field.toolbar.add'),
                        'icon' => '<i class="fa fa-plus"></i>',
                        'aParams' => array('id' => 'add_menu', 'class' => 'add-btn')
                    ),
                    'edit' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.edit'),
                        'icon' => '<i class="fa fa-pencil"></i>',
                        'aParams' => array('id' => 'edit_menu', 'class' => 'edit-btn', 'data-url' => URL::route('admin.menu.edit') )
                    ),
                    'delete' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'aParams' => array('id' => 'delete_menu', 'class' => 'delete-btn', 'data-url' => URL::route('admin.menu.destroy') )
                    ),
                    'refresh' => array(
                        'url' => URL::route('admin.menu'),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh_menu', 'class' => 'refresh-btn', 'data-url' => URL::route('admin.menu') )
                    )
                ),
                'aList' => $this->menues->index()
            ))
        ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( MenuesRepository $menues )
    {
        $aBreadcrumbs = array(
            array('url' => URL::route('admin.menu'), 'icon' => '<i class="fa fa-bars"></i>', 'title' => Lang::get('menues.lists.lists_menues')),
            array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('menues.lists.create_menues'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('menues.lists.management_menues'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('menues.lists.create_new_menues'),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.menu'), 'class'=>'btn-outline btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-outline btn-primary')
                )
            ),
            'formContent' => $this->renderView('menues.add', array(
                'aTypeMenues' => $menues->getMenuTypes(),
                'aMenues' => $menues->getComboList(),
                'oData' => null
            )),
            'formUrl' => URL::route('admin.menu.store'),
        ));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( MenuesRequest $request )
    {
        $this->menues->store( $request->all() );

        return Redirect::route('admin.menu')
            ->with('message', Lang::get('$sMessage') );
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
    public function edit( $id, MenuesRepository $menues )
    {
        $aBreadcrumbs = array(
            array('url' => URL::route('admin.menu'), 'icon' => '<i class="fa fa-bars"></i>', 'title' => Lang::get('menues.lists.lists_menues')),
            array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('menues.lists.editing_menues'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('menues.lists.management_menues'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('menues.lists.editing_menues'),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.menu'), 'class'=>'btn-outline btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-outline btn-primary')
                )
            ),
            'formContent' => $this->renderView('menues.add', array(
                'oData' => $this->menues->edit( $id ),
                'aTypeMenues' => $menues->getMenuTypes(),
                'aMenues' => $menues->getComboList()
            )),
            'formUrl' => URL::route('admin.menu.store'),
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
