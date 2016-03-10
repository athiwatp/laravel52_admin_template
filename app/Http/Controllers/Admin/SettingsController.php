<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\SettingsRequest;
use App\Repositories\SettingsRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
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
        //
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
        $user = $request->user();

        // Max, please read it!!!!!
        // THIS will not work... it should re-written!!!!!

        $this->settings->store( $request->all(), $user ? $user->id : null );

        // Re-direct somewhere!!!!!
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
