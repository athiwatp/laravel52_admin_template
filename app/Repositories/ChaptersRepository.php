<?php namespace App\Repositories;

use App\Models\Chapters as Chapters;
use Carbon\Carbon;

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
    public function index()
    {
        return $this->model->all();
    }

    /**
     * Create or update Message
     *
     * @param App\Models\Chapters $chapters
     *
     * @return
    */
    public function saveChapter( $chapters, $inputs/*, $user_id*/)
    {

        /**
         * NEED TO IMPLEMENT CHAPTERS SAVING PROCESS
        */
        //$chapters->save();

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
    public function store( $chapters, $inputs/*, $user_id*/)
    {
        $chapters = $this->saveChapter(new $this->model, $inputs/*, $user_id*/);

        // some post creation actions will be required
    }

    /**
     * Destroy a message
     *
     * @param App\Models\Chapters
     *
     * @return void
    */
    public function destroy($chapters)
    {
        $chapters->delete();
    }
}
