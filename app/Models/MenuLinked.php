<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Config;

class MenuLinked extends Model
{
    /**
     * The database table used by the model
     *
     * @var string
     */
    protected $table = 'static_linked_menu';

    /**
     * Returns parent for the linked item
     *
     * @return Object
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Menues', 'id_menu', 'id')
            ->where('is_published', Config::get('constants.DONE_STATUS.SUCCESS'));
    }

    /**
     * Returns parent for the linked item
     *
     * @return Object
     */
    public function child()
    {
        return $this->belongsTo('App\Models\Menues', 'id_linked_menu', 'id')
            ->where('is_published', Config::get('constants.DONE_STATUS.SUCCESS'));
    }
}
