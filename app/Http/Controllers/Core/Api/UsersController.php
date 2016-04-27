<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\Users as UsersTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\User;
use League\Fractal\Manager;
use App\Repositories\UserRepository;

class UsersController extends ApiController
{
    /**
     * Injected variable for the chapters
     *
     * @var {App\Repositories\VideoNewsRepository}
     */
    protected $user = null;


    protected $fractal;

    /**
     * Constructor
     */
    public function __construct(Manager $fractal, UserRepository $user)
    {
        $this->fractal = $fractal;

        // inject video
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Datatables::of(User::query())
            ->setTransformer( new UsersTransformer() )
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
     * Destroy the announce item
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
            $result['deleted'] = $this->user->destroy($id);
        }

        return $this->respond( $result );
    }
}
