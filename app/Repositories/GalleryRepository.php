<?php namespace App\Repositories;

use App\Models\Gallery as Gallery;
use Carbon\Carbon, Auth, Lang, Config;
use Illuminate\Http\Request;

class GalleryRepository extends BaseRepository {
    /**
     * Published flag
     *
     * @var String
     */
    protected $PUBLISHED = 0;

    /**
     * Create a new Message instance
     *
     * @param App\Models\Gallery $gallery
     *
     * @return void
    */
    public function __construct(Gallery $gallery)
    {
        $this->model = $gallery;

        // Retrieve the config settings
        $this->PUBLISHED = Config::get('constants.DONE_STATUS.SUCCESS');
    }

        /**
     * Create or update Message
     *
     * @param App\Models\Gallery $gallery
     *
     * @return
    */
    public function index()
    {
        return $this->model->all();
    }

    /**
     * Retrieve the latest gallery from DB
     *
     * @param int $amount - amount of records that we need to retrieve
     *
     * @return Array
     */
    public function getLatest( $amount )
    {
        $result = $this->model
            ->orderBy('created_at', 'DESC')
            ->whereNotNull('filename')
            ->take( $amount )
            ->get();

        if ( $result ) {
            return $result;
        }

        return [];
    }
    /**
     * Reprive the list of news
     *
     * @param Request $request
     *
     * @return Collection
     */
    public function getPaginatedList(Request $request)
    {
        $result = $this->model
            ->orderBy('pos', 'DESC')
            ->paginate( $this->paginationAmount );

        if ( $result ) {
            return $result;
        }

        return [];
    }

    /**
     * Create or update Message
     *
     * @param App\Models\Gallery $gallery
     *
     * @return
    */
    public function saveGallery( $gallery, $inputs )
    {
        $gallery->title        = $inputs['title'];
        $gallery->description  = $inputs['description'];
        $gallery->chapter_id   = ( isset($inputs['chapter_id']) ? $inputs['chapter_id'] : null );
        $gallery->user_id      = Auth::id();
        // $gallery->filename     = $inputs['filename'];
        $gallery->tp           = Config::get('constants.GALLERY.PHOTO');
        $gallery->pos          = $inputs['pos'];

        $gallery->save();

        return true;
    }

    /**
     * Create a message
     *
     * @param array $inputs
     * @param int $user_id
     *
     * @return void
    */
    public function store( $inputs )
    {
        $id = $inputs['id'];

        if ( isset($id) && $id > 0 ) {
            $model = $this->model->find( $id );
        } else {
            $model = new $this->model;
        }

        $gallery = $this->saveGallery( $model, $inputs );

        if ( $this->saveGallery( $model, $inputs ) ) {
            return $model->toArray();
        } else {
            return false;
        }

    }

    /**
     * Edit or update Message
     *
     * @param App\Models\Gallery $gallery
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
     * @param {int} $id
     *
     * @return {Boolean}
    */
    public function destroy($id)
    {
        return parent::destroy( $id );
    }

    // /**
    // * Returns a list of menu types
    // */
    // public static function getTypes() {
    //     return array(
    //         Gallery::TYPE_VIDEO => Lang::get('gallery.form.type_video'),
    //         Gallery::TYPE_PHOTO => Lang::get('gallery.form.type_photo')
    //     );
    // }

    // /**
    //  * Static list for the menu types
    // */
    // public static function getGalleryTypes()
    // {
    //     return array_merge( array(
    //         '0' => ' --- ' . Lang::get('gallery.form.select_type_gallery') . ' --- ' ), self::getTypes()
    //     );
    // }
}
