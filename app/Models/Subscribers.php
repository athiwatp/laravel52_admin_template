<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribers extends Model
{

    /**
     * The database table used by the model
     *
     * @var string
     */
    protected $table = 'subscribers';

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
        return route( 'admin.subscribers.edit', array('id' => $this->id) );
    }
}
