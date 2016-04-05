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

    public static function setSocialNetworks() {
        return array(
        0 => Lang::get('settings.set.select_set'),
        1 => Lang::get('table_field.lists.yes'),
        2 => Lang::get('table_field.lists.no')
            );
    }

    public function getSocialButtons()
    {
        $aData = array();

        foreach($this->index() as $item) {
            $aData[$item->key_name] = $item->value;
        }
        return $aData;
    }
}
