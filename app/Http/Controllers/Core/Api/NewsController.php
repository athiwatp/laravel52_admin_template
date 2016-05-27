<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\News as NewsTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\News;
use League\Fractal\Manager;
use App\Repositories\NewsRepository;
use App\Repositories\UserRepository;
use App\Events\Logs\LogsWasChanged;
use Event;

class NewsController extends ApiController
{
    /**
     * Injected variable for the news
     *
     * @var {App\Repositories\NewsRepository}
     */
    protected $news = null;
    protected $user = null;

    /**
     * Constructor
     */
    public function __construct( Manager $fractal, NewsRepository $news, UserRepository $user )
    {
        // apply parent implementation
        parent::__construct($fractal);

        // page repository
        $this->news = $news;

        // User repository
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $isDashboard = $request->get('dashboard');

        if ( $isDashboard ) {
            return Datatables::of( $this->news->getLatestNews() )
                ->setTransformer( new NewsTransformer() )
                ->make(true);
        }

        return Datatables::of(News::query())
            ->setTransformer( new NewsTransformer() )
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
        $item = News::find($id);

        if ( ! $item)
        {
            return Response::json([
                'error' => [
                    'message' => 'Not Found',
                    'status_code' => 404
                ]
            ], 404);
        }

        return $this->fractal->item( $item, new NewsTransformer() );
    }

    /**
     * Destroy the news item
     *
     * @param id {Integer} - news identifier
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = $this->user->findUserByToken( $request->get('api_token') );
        $news = $this->news->edit( $id );

        Event::fire( new LogsWasChanged(array(
            'comment'     => 'Видалив ',
            'title'       => $news['title'],
            'type'        => 'destroy',
            'object_id'   => $id,
            'object_type' => 'App\Models\News',
            'user_id'     => $user->id
        )));

        $result = [
            'deleted' => false
        ];

        if ($id > 0) {
            $result['deleted'] = $this->news->destroy($id);
        }

        return $this->respond( $result );
    }

}
