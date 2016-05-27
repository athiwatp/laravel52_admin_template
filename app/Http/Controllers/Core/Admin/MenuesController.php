<?php

namespace App\Http\Controllers\Core\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MenuesRequest;
use App\Repositories\MenuesRepository;
use App\Repositories\PagesRepository;
use App\Events\Logs\LogsWasChanged;

use App\Http\Requests;
use App\Http\Controllers\Core\Controller;
use Lang, Redirect, cTemplate, cBreadcrumbs, cForms, URL, Event;

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
    public function __construct( MenuesRepository $menues, PagesRepository $pages )
    {
        $this->menues = $menues;
        $this->pages = $pages;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aBreadcrumbs = array(
            array('url' => '#', 'icon' => '<i class="fa fa-circle-o"></i>', 'title' => Lang::get('menues.lists.lists_menues'))
        );

        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
            'sTitle' => Lang::get('menues.nav.menu_management'),
            'sSubTitle' => Lang::get('menues.lists.menues_online'),
            'sBoxTitle' => Lang::get('menues.lists.lists_menues'),
            'isShownSearchBox' => false,
            'sContent' => $this->renderView('menues.index', array(
                'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
                'sColumnsJson' => json_encode(array(
                    array( 'data'=> 'id' ),
                    array( 'data' => 'title' )
                )),
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
                        'aParams' => array('id' => 'edit', 'disabled' => true, 'class' => 'edit-btn', 'data-url' => URL::route('admin.menu.edit', array('id' => '%id%')) )
                    ),
                    'delete' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'aParams' => array('id' => 'delete', 'disabled' => true,'class' => 'delete-btn', 'data-url' => URL::route('admin.menu.destroy', array('id' => '%id%')) )
                    ),
                    'refresh' => array(
                        'url' => URL::route('admin.menu.index'),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh', 'class' => 'refresh-btn', 'data-url' => URL::route('admin.menu.index') )
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
            array('url' => URL::route('admin.menu.index'), 'icon' => '<i class="fa fa-circle-o"></i>', 'title' => Lang::get('menues.lists.lists_menues')),
            array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('menues.lists.create_menues'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('menues.lists.management_menues'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('menues.lists.create_new_menues'),
            'formJsHandler' => 'menu/form',
            'formFormId' => 'admin_menu_form',
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.menu.index'), 'class'=>'btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => [
                        'class'=>'btn-success',
                        'v-on:click' => 'checkFormBeforeSaving'
                    ]
                )
            ),
            'formSwitcher' => array(
                array(
                    'title' => Lang::get('table_field.lists.published'),
                    'name' => 'is_published'
                )
            ),
            'formContent' => $this->renderView('menues.add', array(
                'aTypeMenues' => $this->menues->getMenuTypes(),
                'aMenues' => $this->menues->getComboList(),
                'aPages' => $this->pages->getComboList(),
                'getRoute' => $this->menues->getRoute(),
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
    public function store( Request $request )
    {
        // dd( $request->all() );
        $validator = $this->validate( $request,
            array(
                'title' => 'required|min:3|max:255',
                'url' => 'required_with:title',
                'type_menu' => 'required|not_in:0',
                'pos' => 'required|numeric',
                'parent_id' => 'required|not_in:-1',
                'redirect_url' => 'required_with:is_redirectable'
                ));

        $menu = $this->menues->store( $request->all() );

        Event::fire( new LogsWasChanged(array(
            'comment' => ( $request->id > 0 ? 'Редагував' : 'Створив' ),
            'object_id'    => $menu['id'],
            'object_type'  => 'App\Models\Menues'
        )));

        if ( $menu && $request->get('page_id') === '0') {
            return Redirect::route('admin.pages.create', array('menu_id' => $menu['id']));
        }

        return Redirect::route('admin.menu.index')
            ->with('message', array(
                'code'      => self::$statusOk,
                'message'   => Lang::get('menues.lists.menues_saved_successfully') ));
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
    public function edit( $id )
    {
        $aBreadcrumbs = array(
            array('url' => URL::route('admin.menu.index'), 'icon' => '<i class="fa fa-circle-o"></i>', 'title' => Lang::get('menues.lists.lists_menues')),
            array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('menues.lists.editing_menues'))
        );
        $oData = $this->menues->edit($id);

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('menues.lists.management_menues'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('menues.lists.editing_menues'),
            'formJsHandler' => 'menu/form',
            'formFormId' => 'admin_menu_form',
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.menu.index'), 'class'=>'btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => [
                        'class'=>'btn btn-success',
                        'v-on:click' => 'checkFormBeforeSaving'
                    ]
                )
            ),
            'formSwitcher' => array(
                array(
                    'title' => Lang::get('table_field.lists.published'),
                    'name' => 'is_published',
                    'value' => $oData->is_published
                )
            ),
            'formContent' => $this->renderView('menues.add', array(
                'oData' => $oData,
                'aTypeMenues' => $this->menues->getMenuTypes(),
                'aPages' => $this->pages->getComboList(),
                'aMenues' => $this->menues->getComboList(),
                'getRoute' => $this->menues->getRoute()
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
