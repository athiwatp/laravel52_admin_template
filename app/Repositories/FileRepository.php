<?php namespace App\Repositories;

use App\Models\File as fModel;
use Auth, Lang;

class FileRepository extends BaseRepository {
    /**
     * Create a new Message instance
     *
     * @param App\Models\File $model
     *
     * @return void
     */
    public function __construct(fModel $model)
    {
        $this->model = $model;
    }

    /**
     * Create or update Message
     *
     * @param App\Models\File $module
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
     * @param App\Models\File $model
     *
     * @return
     */
    public function save( $model, $inputs )
    {
        if ( array_key_exists('path', $inputs) ) {
            $model->path = $inputs['path'];
        }

        if ( array_key_exists('file_type', $inputs) ) {
            $model->file_type = $inputs['file_type'];
        }

        if ( array_key_exists('file_name', $inputs) ) {
            $model->file_name = $inputs['file_name'];
        }

        if ( array_key_exists('file_size', $inputs) ) {
            $model->file_size = $inputs['file_size'];
        }

        if ( array_key_exists('content_id', $inputs) ) {
            $model->content_id = $inputs['content_id'];
        }

        if ( array_key_exists('content_type', $inputs) ) {
            $model->content_type = $inputs['content_type'];
        }

        if ( $inputs ) {
            $model->save();

            return true;
        } else {
            return false;
        }


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
        $id = array_key_exists('id', $inputs) ? $inputs['id'] : 0;

        if ( $id > 0 ) {
            $model = $this->model->find( $id );
        } else {
            $model = new $this->model;
        }

        if ( $this->save( $model, $inputs ) ) {
            return $model->id;
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
     * @param Int $id - identificator of the file
     *
     * @return Int
     */
    public function destroy( $id )
    {
        return $this->model->where('id', $id)
            ->delete();
    }

    /**
     * Return files list by the path
     *
     * @param Array $params - paramethers for the query
     *
     * @return Array
    */
    public function getByPath( $params = [] )
    {
        $result = [];
        $path   = array_key_exists('path', $params) ? str_replace('%s', '%', $params['path']) : '';

        $oQuery = $this->model->where( function($q) use ($path) {
            $q->whereRaw('path LIKE ?', array( $path ));
        })->get();

        if ( $oQuery && $oQuery->count() > 0 ) {
            $result = $oQuery->toArray();
        }

        return $result;
    }
}
