<?php

namespace App\Http\Controllers\Core\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\PagesRequest;
use App\Repositories\PagesRepository;
use App\Repositories\FileRepository;
use App\Repositories\MenuesRepository;
use App\Events\Logs\LogsWasChanged;

use App\Http\Requests;
use App\Http\Controllers\Core\Controller;
use Lang, Redirect, cTemplate, cBreadcrumbs, Event, cForms, URL, Config;

class PagesController extends AdminController
{
    /**
     * The MessageRepository instance
     *
     * @var App\Repositories\PagesRepository
     */
    protected $pages;

    /**
     * Chapter repository
     *
     * @var Object
     */
    protected $chapters;

    /**
     * File repository
     *
     * @var Object repository
     */
    protected $file = null;

    /**
     * Create a new PagesController instance
     *
     * @param App\Repositories\PagesRepository
     *
     * @return void
     */
    public function __construct( PagesRepository $pages, FileRepository $file, MenuesRepository $menu )
    {
        $this->pages = $pages;
        $this->menu = $menu;

        // File repository
        $this->file = $file;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( PagesRequest $input )
    {
        $aBreadcrumbs = array(
            array('url' => '#', 'icon' => '<i class="fa fa-sticky-note"></i>', 'title' => Lang::get('pages.lists.lists_pages'))
        );

        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
            'sTitle' => Lang::get('pages.lists.pages_management'),
            'sSubTitle' => Lang::get('pages.lists.pages_management_online'),
            'sBoxTitle' => Lang::get('pages.lists.page_static_website'),
            'isShownSearchBox' => false,
            'sContent' => $this->renderView('pages.index', array(
                'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
                'aToolbar' => array(
                    'template' => $this->getTheme(),
                    'add' => array(
                        'url' => URL::route('admin.pages.create'),
                        'title' => Lang::get('table_field.toolbar.add'),
                        'icon' => '<i class="fa fa-plus"></i>',
                        'aParams' => array('id' => 'add_page')
                    ),
                    'edit' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.edit'),
                        'icon' => '<i class="fa fa-pencil"></i>',
                        'aParams' => array('id' => 'edit', 'disabled' => true, 'class' => 'edit-btn', 'data-url' => URL::route('admin.pages.edit', array('id' => '%id%')) )
                    ),
                    'delete' => array(
                        'url' => '#', 
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'aParams' => array('id' => 'delete', 'disabled' => true, 'class' => 'delete-btn', 'data-url' => URL::route('admin.pages.destroy', array('id' => '%id%')) )
                    ),
                    'refresh' => array(
                        'url' => URL::route('admin.pages.index'),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh', 'class' => 'refresh-btn', 'data-url' => URL::route('admin.pages.index') )
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
    public function create( PagesRequest $input )
    {
        $oMenuId = null;

        $aBreadcrumbs = array(
            array('url' => URL::route('admin.pages.index'), 'icon' => '<i class="fa fa-sticky-note"></i>', 'title' => Lang::get('pages.lists.lists_pages')),
            array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('pages.lists.create_page'))
        );

        if ( isset($input) && $input->get('menu_id') > 0 ) {
            $oMenuId = $input->get('menu_id');
        }

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('pages.lists.pages_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('pages.lists.create_new_pages'),
            'useCKEditor' => true,
            'formJsHandler' => 'pages/form',
            'formFormId' => 'admin_pages_form',
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.pages.index'), 'class'=>'btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-success')
                )
            ),
            'formSwitcher' => array(
                array(
                    'title' => Lang::get('table_field.lists.published'),
                    'name' => 'is_published'
                )
            ),
            'formContent' => $this->renderView('pages.add', array(
                'oData' => null,
                'oMenuId' => $oMenuId
            )),
            'formUrl' => URL::route('admin.pages.store'),
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
        $validator = $this->validate( $request,
            array(
                'title' => 'required|min:3|max:255',
                'url' => 'required_with:title'
                ));

        if ($page = $this->pages->store( $request->only([
            'title',
            'url',
            'subtitle',
            'content',
            'is_published',
            'meta_keywords',
            'meta_descriptions',
            'id',
        ]))) {
            $TYPE_PAGE = Config::get('constants.RESOURCES.PAGE');

            // Check the files for current content
            $this->file->correct($request->get('_token'), $page['id'], $TYPE_PAGE);
        }

        Event::fire( new LogsWasChanged(array(
            'comment' => ( $request->id > 0 ? 'Редагував' : 'Створив' ),
            'object_id'    => $page['id'],
            'object_type'  => 'App\Models\Pages'
        )));

        if ($request->all() && $request->get('menu_id') > 0 ) {
            $this->menu->fixChanges( $request->get('menu_id'), [
                'page_id' => $page['id']
            ]);
            return Redirect::route('admin.menu.index')
                ->with('message', array(
                    'code'      => self::$statusOk,
                    'message'   => Lang::get('pages.lists.pages_and_menu_saved_successfully') ));
        }

        return Redirect::route('admin.pages.index')
            ->with('message', array(
                'code'      => self::$statusOk,
                'message'   => Lang::get('pages.lists.pages_saved_successfully') ));
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
            array('url' => URL::route('admin.pages.index'), 'icon' => '<i class="fa fa-sticky-note"></i>', 'title' => Lang::get('pages.lists.lists_pages')),
            array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('pages.lists.editing_pages'))
        );
        $oData = $this->pages->edit($id);

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('pages.lists.pages_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('pages.lists.editing_page'),
            'useCKEditor' => true,
            'formJsHandler' => 'pages/form',
            'formFormId' => 'admin_pages_form',
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.pages.index'), 'class'=>'btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-success')
                )
            ),
            'formSwitcher' => array(
                array(
                    'title' => Lang::get('table_field.lists.published'),
                    'name' => 'is_published',
                    'value' => $oData['is_published']
                )
            ),
            'formContent' => $this->renderView('pages.add', array(
                'oData' => $oData
            )),
            'formUrl' => URL::route('admin.pages.store'),
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

    //// TEMP: SHOULD BE REMOVED
    public function sync() 
    {
        $sync = $this->pages->sync( $start = 0 );

        return Redirect::route('admin.pages.index', array('start' => $start))
            ->with('message', array(
                'code' => self::$statusOk,
                'message' => Lang::get('table_field.sync.message')
            ));
    }
    ///

}
