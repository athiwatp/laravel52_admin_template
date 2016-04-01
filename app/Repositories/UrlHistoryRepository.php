<?php namespace App\Repositories;

use App\Models\UrlHistory as UrlHistory;
use Carbon\Carbon, Auth;

class UrlHistoryRepository extends BaseRepository {

    /**
     * Create a new Message instance
     *
     * @param App\Models\UrlHistory $urlHist
     *
     * @return void
    */
    public function __construct(UrlHistory $url)
    {
        $this->model = $url;
    }

    /**
     * Create or update Message
     *
     * @param App\Models\UrlHistory $url
     *
     * @return
    */
    public function savePage( $url, $inputs )
    {
        $url->date      = $inputs['date'];
        $url->type_id   = $inputs['type_id'];
        $url->url       = $inputs['url'];
        $url->type      = $inputs['type'];

        $page->save();

        return true;
    }

    /**
     * Create a message
     *
     * @param array $inputs
     *
     * @return void
    */
    public function store( $inputs )
    {
        $pages = $this->savePage( new $this->model, $inputs );
    }

    /**
    * Prepare a list of chapters for the combox
    */
    public static function getTypeId($url, $aType = null )
    {
        $aType = (empty($aType) ? Config::get('constants.URL_HISTORY.TYPE_MENU') : $aType);

        if ( is_array($aType) === false ) {
            $aType = array($aType);
        }

        $oItems = UrlHistory::where('url', '=', $url)
            ->whereIn('type', $aType)
            ->orderBy('created_at', 'DESC')
            ->first();

        if ( $oItems ) {
            return json_decode(json_encode(array(
                'id' => $oItems->type_id,
                'type' => $oItems->type
            )), FALSE);
        }

        return json_decode(json_encode(array(
            'id' => $url,
            'type' => reset($aType)
        )), FALSE);
    }
}
