<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lang, Redirect, cTemplate, cBreadcrumbs, cForms, URL, Gate;

class UsersController extends AdminController
{
        /**
     * The MessageRepository instance
     *
     * @var App\Repositories\UsersRepository
     */
    protected $menues;

    /**
     * Create a new UsersController instance
     *
     * @param App\Repositories\UsersRepository
     *
     * @return void
     */
    public function __construct( UserRepository $users )
    {
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('read-users')) {
            abort(403);
        }
        
        $aBreadcrumbs = array(
            array('url' => '#', 'icon' => '<i class="fa fa-users"></i>', 'title' => Lang::get('users.lists.lists_users'))
        );

        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
            'sTitle' => Lang::get('users.lists.users_management'),
            'sSubTitle' => Lang::get('users.lists.user_management_site'),
            'sBoxTitle' => Lang::get('users.lists.lists_users'),
            'isShownSearchBox' => false,
            'sContent' => $this->renderView('user.index', array(
                'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), $aBreadcrumbs ),
                'sColumnsJson' => json_encode(array(
                    array( 'data'=> 'id' ),
                    array( 'data' => 'name' ),
                    array( 'data' => 'email' ),
                    array( 'data' => 'phone' )
                )),
                'aToolbar' => array(
                    'template' => $this->getTheme(),
                    'add' => array(
                        'url' => URL::route('admin.users.create'),
                        'title' => Lang::get('table_field.toolbar.add'),
                        'icon' => '<i class="fa fa-plus"></i>',
                        'aParams' => array('id' => 'add_user', 'class' => 'add-btn')
                    ),
                    'edit' => array(
                        'url' => '#',
                        'title' => Lang::get('table_field.toolbar.edit'),
                        'icon' => '<i class="fa fa-pencil"></i>',
                        'aParams' => array('id' => 'edit_user', 'class' => 'edit-btn', 'data-url' => URL::route('admin.users.edit', array('id' => '%id%')) )
                    ),
                    'delete' => array(
                        'url' => '#',
                        'title' => Lang::get('table_field.toolbar.remove'),
                        'icon' => '<i class="fa fa-trash-o"></i>',
                        'aParams' => array('id' => 'delete_user', 'class' => 'delete-btn', 'data-url' => URL::route('admin.users.destroy', array('id' => '%id%')) )
                    ),
                    'refresh' => array(
                        'url' => URL::route('admin.users.index'),
                        'title' => Lang::get('table_field.toolbar.refresh'),
                        'icon' => '<i class="fa fa-refresh"></i>',
                        'aParams' => array('id' => 'refresh_user', 'class' => 'refresh-btn', 'data-url' => URL::route('admin.users.index') )
                    )
                ),
                // 'aList' => $this->users->index()
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
            array('url' => URL::route('admin.users.index'), 'icon' => '<i class="fa fa-users"></i>', 'title' => Lang::get('users.lists.lists_users')),
            array('url' => '#', 'icon' => '<i class="fa fa-plus"></i>', 'title' => Lang::get('users.lists.register'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('users.lists.users_management'),
            'formSubChapter' => Lang::get('users.lists.register_user'),
            'formTitle' => Lang::get('users.lists.create_new_users'),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.users.index'), 'class'=>'btn-outline btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-outline btn-primary')
                )
            ),
            'formContent' => $this->renderView('user.register', array(
                'oData' => null
            )),
            'formUrl' => URL::route('admin.users.store'),
        ));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( UserRequest $request )
    {
        $this->users->store( $request->all() );

        return Redirect::route('admin.users.index')
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
    public function edit( $id, UserRepository $users )
    {
        $aBreadcrumbs = array(
            array('url' => URL::route('admin.users.index'), 'icon' => '<i class="fa fa-users"></i>', 'title' => Lang::get('users.lists.lists_users')),
            array('url' => '#', 'icon' => '<i class="fa fa-pencil"></i>', 'title' => Lang::get('users.lists.editing_user'))
        );

        return cForms::createForm( $this->getTheme(), array(
            'sFormBreadcrumbs' => cBreadcrumbs::getItems($this->getTheme(), $aBreadcrumbs),
            'formChapter' => Lang::get('users.lists.users_management'),
            'formSubChapter' => '',
            'formTitle' => Lang::get('users.lists.editing_user'),
            'formButtons' => array(
                array(
                    'title' => '<i class="fa fa-arrow-left"></i> ' . Lang::get('table_field.lists.back'),
                    'type' => 'link',
                    'params' => array('url' => URL::route('admin.users.index'), 'class'=>'btn-outline btn-default')
                ),
                array(
                    'title' => Lang::get('table_field.lists.save'),
                    'type' => 'submit',
                    'params' => array('class'=>'btn-outline btn-primary')
                )
            ),
            'formContent' => $this->renderView('user.edit', array(
                'oData' => $this->users->edit( $id )
            )),
            'formUrl' => URL::route('admin.users.store'),
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
