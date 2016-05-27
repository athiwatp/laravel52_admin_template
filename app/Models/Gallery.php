<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

    /**
     * The database table used by the model
     *
     * @var string
    */
    protected $table = 'gallery';

    /**
     * Returns the list of logs which are related to current announce
     *
    */
    public function logs()
    {
       return $this->morphMany('App\Modules\Logs', 'object');
    }

    public function getEditurlAttribute()
    {
        return route( 'admin.gallery.edit', array('id' => $this->id) );
    }
}
