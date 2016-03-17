<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Repositories\NewsRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lang, Redirect;

class NewsController extends AdminController
{
    /**
     * The MessageRepository instance
     *
     * @var App\Repositories\NewsRepository
     */
    protected $news;

    /**
     * Create a new NewsController instance
     *
     * @param App\Repositories\NewsRepository
     *
     * @return void
     */
    public function __construct( NewsRepository $news )
    {
        $this->news = $news;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->renderView('admin.news.index', array(
            'aList' => $this->news->index()
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
        return $this->renderView('news.add', array(
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
    public function store( NewsRequest $request )
    {
        $this->news->store( $request->all() );

        return Redirect::route('admin.news.index')
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
        return $this->renderView('news.add', array(
            'oData' => $this->news->edit( $id )
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
