<?php namespace App\Repositories;

use App\Models\Announcements as Announce;
use Illuminate\Http\Request;
use Carbon\Carbon, Auth, Config;

class AnnouncementsRepository extends BaseRepository {

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
        $announce->title        = $inputs['title'];
        $announce->description  = $inputs['description'];
        $announce->important    = ( isset($inputs['important']) ? $inputs['important'] : 0 );
        $announce->date_start   = $inputs['date_start'];
        $announce->date_end     = $inputs['date_end'];
        $announce->chapter_id   = ( isset($inputs['chapter_id']) ? $inputs['chapter_id'] : null );
        $announce->user_id      = Auth::id();
        $announce->is_published = $inputs['is_published'];

        $announce->save();

        return true;
    }


    /**
     * Retrieve the latest IMPORTANT ANONCEs from DB
     *
     * @param int $amount - amount of records that we need to retrieve
     *
     * @return Array
     */
    public function getLatest( $amount, $important = false )
    {
        $result = $this->model
            ->where('important', $important === true ? '1' : '0')
            ->orderBy('date_start', 'ASC')
            ->take( $amount )
            ->get();

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
