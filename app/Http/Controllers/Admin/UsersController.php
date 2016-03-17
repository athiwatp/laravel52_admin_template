<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lang, Redirect;

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

        return $this->renderView('user.index', array(
            'aList' => $this->users->index()
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
        return $this->renderView('user.register', array(
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
        return $this->renderView('user.edit', array(
            'oData' => $this->users->edit( $id )
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
