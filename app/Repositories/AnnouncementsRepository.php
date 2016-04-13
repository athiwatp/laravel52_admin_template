<?php namespace App\Repositories;

use App\Models\Announcements as Announce;
use Illuminate\Http\Request;
use Carbon\Carbon, Auth, Config;

class AnnouncementsRepository extends BaseRepository {

    /**
     * Published flag
     *
     * @var String
     */
    protected $PUBLISHED = 0;

    /**
     * Create a new Message instance
     *
     * @param App\Models\Announce $announce
     *
     * @return void
    */
    public function __construct( Announce $announce )
    {
        // Announce Model
        $this->model = $announce;

        // Retrieve the config settings
        $this->PUBLISHED = Config::get('constants.DONE_STATUS.SUCCESS');
    }

    /**
     * Create or update Message
     *
     * @param App\Models\Announce $announce
     *
     * @return Collection of Object
    */
    public function index()
    {
        return $this->model->all();
    }

    /**
     * Create or update Message
     *
     * @param App\Models\Announce $announce
     *
     * @return
    */
    public function saveAnnounce( $announce, $inputs )
    {
        foreach( $inputs as $key => $val ) {
            $announce->$key = $val;
        }

        $announce->user_id    = Auth::id();
        $announce->important  = ( isset($inputs['important']) ? $inputs['important'] : 0 );
        $announce->is_topical = ( isset($inputs['is_topical']) ? $inputs['is_topical'] : 0 );

        if ( ! $announce->is_topical ) {
            $announce->top_date_end = null;
        } else {
            if ( empty($announce->top_date_end) ) {
                $announce->top_date_end = Carbon::now()->addDays(3);
            }
        }

        if ($announce && count($inputs) > 0 ) {
            $announce->save();
        }

        return true;
    }


    /**
     * Retrieve the latest IMPORTANT ANONCEs from DB
     *
     * @param int $amount - amount of records that we need to retrieve
     * @param Boolean $important
     * @param Boolean $topical
     *
     * @return Array
     */
    public function getLatest( $amount, $important = false, $topical = false )
    {
        $object = $this->model
            ->where( 'is_published', $this->PUBLISHED )

            ->orderBy('date_start', 'ASC')
            ->take( $amount );

        if ( $important === true ) {
            $object->where('important', '1');
        } elseif ( $important === false ) {
            $object->where('important', '0');
        }

        if ( $topical === true ) {
            $object->where('is_topical', '1')
                ->where('top_date_end', '>=', date('Y-m-d') . ' 00:00:00');
        } elseif ( $topical === false ) {
            $object->where('is_topical', '0');
        }

        $result = $object->get();

        if ( $result ) {
            return $result;
        }

        return [];
    }

    /**
     * Retrieve the list of the announces
     *
     * @param Request $request
     *
     * @return Collection
     */
    public function getPaginatedList(Request $request)
    {
        $result = $this->model
            ->where( 'is_published', $this->PUBLISHED )
            ->orderBy('date_start', 'DESC')
            ->paginate( $this->paginationAmount );

        if ( $result ) {
            return $result;
        }

        return [];
    }

    /**
     * Create a news
     *
     * @param array $inputs
     *
     * @return mixed ( App\Models\Announce | false )
    */
    public function store( $inputs )
    {
        $id = $inputs['id'];

        if ( isset($id) && $id > 0 ) {
            $model = $this->model->find( $id );
        } else {
            $model = new $this->model;
        }

        if ( $this->saveAnnounce( $model, $inputs ) ) {
            return $model->toArray();
        } else {
            return false;
        }
    }

    /**
     * Edit or update Message
     *
     * @param App\Models\Announce $announce
     *
     * @return
    */
    public function edit( $id )
    {
        return $this->model->find($id);
    }

    /**
     * Destroy a message
     *
     * @param App\Models\Announce
     *
     * @return void
    */
    public function destroy($announce)
    {
        $news->delete();
    }
}
