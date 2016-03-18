<?php namespace App\Repositories;

use App\Models\Gallery as Gallery;
use Carbon\Carbon, Auth, Lang;

class GalleryRepository extends BaseRepository {
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
        $gallery->user_id      = 1/*Auth::id()*/;
        $gallery->filename     = $inputs['filename'];
        $gallery->tp           = '1';
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

        // some post creation actions will be required
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
     * @param App\Models\Gallery
     *
     * @return void
    */
    public function destroy($gallery)
    {
        $gallery->delete();
    }

    /**
    * Returns a list of menu types
    */
    public static function getTypes() {
        return array(
            Gallery::TYPE_VIDEO => Lang::get('gallery.form.type_video'),
            Gallery::TYPE_PHOTO => Lang::get('gallery.form.type_photo')
        );
    }

    /**
     * Static list for the menu types
    */
    public static function getGalleryTypes()
    {
        return array_merge( array(
            '0' => ' --- ' . Lang::get('gallery.form.select_type_gallery') . ' --- ' ), self::getTypes()
        );
    }
}
