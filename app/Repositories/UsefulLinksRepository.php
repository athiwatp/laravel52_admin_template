<?php namespace App\Repositories;

use App\Models\UsefulLinks;
use Carbon\Carbon, Auth, Lang, Config, cTrackChangesUrl;

class UsefulLinksRepository extends BaseRepository {

    /**
     * UsefulLinks instance
     *
     * @var App\Repositories\UsefulLinksRepository
     */
    protected $usefulLinks = null;

    /**
     * Create a new Message instance
     *
     * @param App\Models\UsefulLinks $usefulLinks
     *
     * @return void
    */
    public function __construct( UsefulLinks $usefulLinks = null )
    {
        if ( $usefulLinks === null ) {
            $usefulLinks = new UsefulLinks();
        }

        $this->model = $usefulLinks;
    }

    /**
     * Create or update Message
     *
     * @param App\Models\UsefulLinks $usefulLinks
     *
     * @return
    */
    public function index()
    {
        return $this->model->all();
    }

    /**
     * Create or update Message
     *
     * @param App\Models\UsefulLinks $link
     *
     * @return
    */
    public function saveUsefulLinks( $link, $inputs )
    {
        $link->title        = $inputs['title'];
        $link->url          = $inputs['url'];
        $link->chapter_id   = $inputs['chapter_id'];
        $link->description  = $inputs['description'];
        $link->is_active    = $inputs['is_active'];

        if ( $link->save() ) {
            return $link;
        }

        return false;
    }

    /**
     * Create a useful links
     *
     * @param array $inputs
     *
     * @return mixed ( App\Models\UsefulLinks | false )
    */
    public function store( $inputs )
    {
        $id = $inputs['id'];

        if ( isset($id) && $id > 0 ) {
            $model = $this->model->find( $id );
        } else {
            $model = new $this->model;
        }

        $link = $this->saveUsefulLinks( $model, $inputs );

        if ( $link ) {
            return $link;
        }
        return false;
    }

    /**
     * Edit or update Message
     *
     * @param App\Models\UsefulLinks $usefulLinks
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
     * @param {Int} id - identifier for the usefulLinks
     *
     * @return void
    */
    public function destroy($id)
    {
        return parent::destroy($id);
    }

    /**
     * Retrieve the active usefulLinks from DB
     *
     * @param int $amount - amount of records that we need to retrieve
     *
     * @return Array
    */
    public function getUsefulLinks( $aChapterId )
    {
        $result = $this->model
            ->where('is_active', Config::get('constants.DONE_STATUS.SUCCESS'))
            ->where('chapter_id', '=', $aChapterId)
            ->orderBy('title')
            ->get();

        if ( $result ) {
            return $result;
        }

        return [];
    }
}
