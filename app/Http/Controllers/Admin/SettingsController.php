<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\SettingsRequest;
use App\Repositories\SettingsRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect, Lang;

class SettingsController extends AdminController
{
    /**
     * The MessageRepository instance
     *
     * @var App\Repositories\SettingsRepository
     */
    protected $settings;

    /**
     * Create a new SettingsController instance
     *
     * @param App\Repositories\SettingsRepository
     *
     * @return void
     */
    public function __construct( SettingsRepository $settings )
    {
        $this->settings = $settings;

        $this->middleware('guest');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aData = array();

        foreach($this->settings->index() as $item) {
            $aData[$item->key_name] = $item->value;
        }

        return $this->renderView('settings.add', array(
            'aData' => $aData
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store( SettingsRequest $request )
    {
        // $user = $request->users();

        // Max, please read it!!!!!
        // THIS will not work... it should re-written!!!!!

        $this->settings->store( $request->all()/*, $user ? $user->id : null */);

        // Re-direct somewhere!!!!!
        return Redirect::route('admin.settings')
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
        //
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