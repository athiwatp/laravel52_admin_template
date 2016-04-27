<?php namespace App\Repositories;

use App\Models\Chapters as Chapters;
use Carbon\Carbon, Lang, Auth, Config;

class ChaptersRepository extends BaseRepository {
    /**
     * Create a new Message instance
     *
     * @param App\Models\Chapters $chapters
     *
     * @return void
    */
    public function __construct(Chapters $chapters)
    {
        $this->model = $chapters;
    }

        /**
     * Create or update Message
     *
     * @param App\Models\Chapters $chapters
     *
     * @return
    */
    public function index( $sType )
    {
        return $this->model->where('type_chapter', '=', $sType)->get();
    }

    /**
     * Create or update Message
     *
     * @param App\Models\Chapters $chapters
     *
     * @return
    */
    public function saveChapter( $chapter, $inputs )
    {
        $chapter->title        = $inputs['title'];
        $chapter->description  = $inputs['description'];
        $chapter->pos          = ( isset($inputs['pos']) ? $inputs['pos'] : null );
        $chapter->is_active    = $inputs['is_active'];
        $chapter->type_chapter = ( isset($inputs['sType']) ? $inputs['sType'] : $chapter->type_chapter );
        $chapter->user_id      = Auth::id();

        $chapter->save();

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

        $chapters = $this->saveChapter( $model, $inputs );

        if ( $this->saveChapter( $model, $inputs ) ) {
            return $model->toArray();
        } else {
            return false;
        }
    }

    /**
     * Edit or update Message
     *
     * @param App\Models\Chapters $chapters
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
     * @param App\Models\Chapters
     *
     * @return void
    */
    public function destroy($id)
    {
        return parent::destroy($id);
    }

    /**
    * Prepare a list of chapters for the combox
    */
    public static function getComboList( $sChaptersType )
    {
        $aItems = array( 0 => ' --- ' . Lang::get('chapters.lists.select_chapter') . ' --- ' );

        $oItems = Chapters::where('type_chapter', '=', $sChaptersType)
            ->where('is_active', '=', Config::get('constants.DONE_STATUS.SUCCESS'))
            ->orderBy('pos')
            ->orderBy('title')
            ->get();

        foreach($oItems as $item) {
            $aItems[ $item->id ] = $item->title;
        }

        return $aItems;
    }

}
