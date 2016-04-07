<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\Menues as MenuTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Menues;

class MenuController extends ApiController
{
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
}
