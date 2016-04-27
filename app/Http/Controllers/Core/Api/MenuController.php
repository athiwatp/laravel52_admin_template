<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\Menues as MenuTransformer;
use Yajra\Datatables\Facades\Datatables;
use League\Fractal\Manager;
use App\Models\Menues;
use App\Repositories\MenuesRepository;

class MenuController extends ApiController
{
    /**
     * Menu repository
     *
     * @var {Object}
    */
    protected $menu = null;

    /**
     * Extend the constructor for the API
    */
    public function __construct(Manager $fractal, MenuesRepository $menu)
    {
        parent::__construct($fractal);

        // INject menu repository
        $this->menu = $menu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sType = $request->get('type');
        $query = Menues::where('id', '>', 0);

        if ( $sType ) {
            $query->where('type_menu', $sType)->orderBy('path')
                ->orderBy('pos')
                ->orderBy('title');
        }

        return Datatables::of($query)
            ->setTransformer( new MenuTransformer() )
            ->make(true);
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
     * Destroy the menu item
     *
     * @param id {Integer} - menu identifier
     *
     * @return \Illuminate\Http\Response
    */
    public function destroy(Request $request, $id)
    {
        $result = [
            'deleted' => false
        ];

        if ($id > 0) {
            $result['deleted'] = $this->menu->destroy($id);
        }

        return $this->respond( $result );
    }
}



