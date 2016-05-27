<?php namespace App\Repositories;

use App\Models\Settings as Settings;
use Carbon\Carbon, Lang;

class SettingsRepository extends BaseRepository {
    /**
     * Create a new Message instance
     *
     * @param App\Models\Settings $settings
     *
     * @return void
    */
    public function __construct(Settings $settings = null )
    {
        if ( $settings === null ) {
            $settings = new Settings();
        }

        $this->model = $settings;
    }

        /**
     * Create or update Message
     *
     * @param App\Models\Settings $settings
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
     * @param App\Models\Settings $settings
     *
     * @return
    */
    public function saveSettings( $settings, $inputs/*, $user_id*/)
    {

        $affectedRows = $this->model->where('id', '>', 0)->delete();

        foreach($inputs as $key => $val) {
            $aToInsert[] = array(
                'key_name' => $key,
                'value' => $val,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            );
        }

        if ($aToInsert) {
            $bResult = $settings->insert($aToInsert);
        }

        return $bResult;
    }

    /**
     * Create a message
     *
     * @param array $inputs
     * @param int $user_id
     *
     * @return void
    */
    public function store($inputs)
    {
        $settings = $this->saveSettings(new $this->model, $inputs);

        return $settings;
    }

    /**
     * Destroy a message
     *
     * @param App\Models\Settings
     *
     * @return void
    */
    public function destroy($settings)
    {
        $settings->delete();
    }

    /**
     * Returns settings parameters
     *
     * @param String $key - the parameter key
     * @param String $default - default value for the key
     *
     * @return mixed
    */
    public function getSettings( $key = null, $default = null )
    {
        $aData = array();
        $list  = $this->index();

        foreach($list as $item) {

            if ( $key && $key == $item->key_name ) {
                return $item->value;
            }

            $aData[$item->key_name] = $item->value;
        }

        if ( empty($key) === false ) {
            return ($default === null ? '' : $default);
        }

        return $aData;
    }
}
