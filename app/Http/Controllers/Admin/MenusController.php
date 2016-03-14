<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MenusRequest;
use App\Repositories\MenusRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lang, Redirect;

class MenusController extends AdminController
{
    /**
     * The MessageRepository instance
     *
     * @var App\Repositories\MenusRepository
     */
    protected $menus;

    /**
     * Create a new MenusController instance
     *
     * @param App\Repositories\MenusRepository
     *
     * @return void
     */
    public function __construct( MenusRepository $menus )
    {
        $this->menus = $menus;

        $this->middleware('guest');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->renderView('menus.index', array(
            'aList' => $this->menus->index()
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->renderView('menus.add', array(
            'oData' => null
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( MenusRequest $request )
    {
        $this->menus->store( $request->all() );

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
    public function edit($id)
    {
        return $this->renderView('menus.add', array(
            'oData' => $this->menus->edit( $id )
            )
        );
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
        $this->menus->destroy( $id );

        return Redirect::route('admin.menu')
            ->with('message', Lang::get('$sMessage') );
    }
}
