<?php namespace App\Repositories;

use App\Models\Settings as Settings;

class SettingsRepository extends BaseRepository {
    /**
     * Create a new Message instance
     *
     * @param App\Models\Settings $settings
     *
     * @return void
    */
    public function __construct(Settings $settings)
    {
        $this->model = $settings;
    }

    /**
     * Create or update Message
     *
     * @param App\Models\Settings $settings
     *
     * @return
    */
    public function saveSettings( $settings, $inputs, $user_id)
    {

        /**
         * NEED TO IMPLEMENT SETTINGS SAVING PROCESS
        */
        //$settings->save();

        return $settings;
    }

    /**
     * Create a message
     *
     * @param array $inputs
     * @param int $user_id
     *
     * @return void
    */
    public function store($inputs, $user_id)
    {
        $settings = $this->saveSettings(new $this->model, $inputs, $user_id);

        // some post creation actions will be required
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
}
