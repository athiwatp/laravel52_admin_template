<?php namespace App\Repositories;

use App\Models\File as fModel;
use Auth, Lang, Config;

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

        if ( array_key_exists('session_id', $inputs) ) {
            $model->session_id = $inputs['session_id'];
        }

        if ( array_key_exists('content_type', $inputs) ) {
            $model->content_type = $inputs['content_type'];
        }

        if ( array_key_exists('parent_id', $inputs) ) {
            $model->parent_id = $inputs['parent_id'];
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
     * Returns collection of files by the filters which can be specified in aParams
     *
     * @param {Array}$aParams  -the list of parameters
     *
     * @return {Array} of Objects
    */
    public function getLatest($aParams = [])
    {
        $docType = Config::get('constants.DOCUMENTS');

        $query = $this->model->whereNull('parent_id')
            ->orderBy('created_at', 'DESC');

        if ( array_key_exists('file_type', $aParams) && $aParams['file_type'] ) {
            if ( $aParams['file_type'] == $docType['FILE_DOC'] ) {
                $query->whereRaw('UPPER(file_type) NOT LIKE ?', ['image/%']);
            } else {
                $query->whereRaw('UPPER(file_type) LIKE ?', ['image/%']);
            }
        }

        if ( array_key_exists('content_type', $aParams) && $aParams['content_type'] ) {
            $query->where('content_type', $aParams['content_type']);
        }

//        dd( $this->toSQL($query) );
//dd($query->paginate( $this->paginationAmount ));
        return (Object) [
            'count' => $query->count(),
            'sum' => $query->sum('file_size'),
            'list' => $query->paginate( $this->paginationAmount )
        ];
    }

    /**
     * Check if there is a files which were loaded for the particular content
     *
     * @paran String $token
     * @param Integer $contentId
     * @param String $contentType
     *
     * @return Boolean
    */
    public function correct($token, $contentId, $contentType)
    {
        $result = $this->model->whereNull('content_id')
            ->where('session_id', $token)
            ->first();

        if ( $result && $result->count() > 0 ) {
            $aPathParts = explode('/', $result->path);
            if ($aPathParts)  {
                $filename = $aPathParts[count($aPathParts)-1];

                $res = $this->model->whereRaw('path LIKE ?', ['%' . '/' . $filename])
                    ->whereNull('content_id')
                    ->update([
                        'content_id' => $contentId,
                        'content_type' => $contentType,
                        'session_id' => null
                    ]);

                return $res;
            }
        }

        return false;
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

    /**
     * Returns a list of file statuses
     *
     * @return Array
     */
    public function getFileTypes()
    {
        $document = Config::get('constants.DOCUMENTS');

        return [
            '0' => ' --- ' . 'Виберіть, будь-ласка, тип документу' . ' --- ',
            $document['FILE_DOC'] => 'Документ',
            $document['FILE_IMAGE'] => 'Зображення',
        ];
    }

    /**
     * Returns a list of resource types
     *
     * @return Array
    */
    public function getContentType()
    {
        $resources = Config::get('constants.RESOURCES');

        return [
            '0' => ' --- ' . 'Фільтрувати по типу ресурсу' . ' --- ',
            $resources['NEWS'] => 'Новини',
            $resources['PHOTO_GALLERY'] => 'Фото галерея',
            $resources['VIDEO'] => 'Відео галерея',
            $resources['ANNOUNCE'] => 'Анонси та оголошення',
        ];
    }


}
