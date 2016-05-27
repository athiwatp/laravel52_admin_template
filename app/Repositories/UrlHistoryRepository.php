<?php namespace App\Repositories;

use App\Models\UrlHistory as UrlHistory;
use Carbon\Carbon, Auth;

class UrlHistoryRepository extends BaseRepository {

    /**
     * UrlHistory instance
     *
     * @var App\Repositories\UrlHistoryRepository
     */
    protected $url = null;

    /**
     * Create a new Message instance
     *
     * @param App\Models\UrlHistory $url
     *
     * @return void
    */
    public function __construct( UrlHistory $url = null )
    {
        if ($url === null) {
            $url = new UrlHistory();
        }

        $this->model = $url;
    }

    /**
     * Create or update Message
     *
     * @param App\Models\UrlHistory $url
     *
     * @return
    */
    public function saveUrlHistory( $sContentId, $sType, $sUrl )
    {
        $historyUrl = $this->getFindUrl( $sContentId, $sType, $sUrl );

        if ( $historyUrl === null ) {
            $history = new UrlHistory;

            $history->type_id   = $sContentId;
            $history->url       = $sUrl;
            $history->type      = $sType;
            $history->add_date  = Carbon::now()->toDateString();

            if ( $history->save() ) {
                return $history;
            }
        }

        return false;
    }

    /**
     * Create a message
     *
     * @param array $inputs
     *
     * @return void
    */
    public function getFindUrl( $sContentId = 0, $type, $url )
    {
        $findUrl = $this->model
            ->where('type', '=', $type)
            ->where('url', '=', $url);

        if ( $sContentId > 0 ) {
            $findUrl->where('type_id', '=', $sContentId);
        }

        return $findUrl->first();
    }

    /**
    * Prepare a list of chapters for the combox
    */
    public function getTypeId($url, $aType = null )
    {
        $aType = (empty($aType) ? Config::get('constants.URL_HISTORY.TYPE_MENU') : $aType);

        if ( is_array($aType) === false ) {
            $aType = array($aType);
        }

        $oItems = $this->model->where('url', '=', $url)
            ->whereIn('type', $aType)
            ->orderBy('created_at', 'DESC')
            ->first();

        if ( $oItems ) {
            return (object) array(
                'id' => $oItems->type_id,
                'type' => $oItems->type,
                'status' => true
            );
        }

        return (object) array(
            'id' => $url,
            'type' => reset($aType),
            'status' => false
        );
    }

    public function getDestroyById( $id, $sType )
    {
        $this->model->where('type_id', '=', $id)
            ->where('type', '=', $sType)
            ->delete();
    }
}
