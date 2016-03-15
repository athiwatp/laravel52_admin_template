<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MenuesRequest;
use App\Repositories\MenuesRepository;
use App\Providers\HelperServiceProvider;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lang, Redirect, cTemplate, cBreadcrumbs, URL;

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
        return $this->renderView('menues.index', array(
            'aList' => $this->menues->index()
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( MenuesRepository $menues )
    {
        return $this->renderView('menues.add', array(
            'oData' => null,
            'aTypeMenues' => $menues->getMenuTypes(),
            'aMenues' => $menues->getComboList(),
            )
        );
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
        return $this->renderView('menues.add', array(
            'oData' => $this->menues->edit( $id ),
            'aTypeMenues' => $menues->getMenuTypes(),
            'aMenues' => $menues->getComboList(),
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
        //
    }
}
