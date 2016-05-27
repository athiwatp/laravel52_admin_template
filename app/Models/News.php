<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    /**
     * The database table used by the model
     *
     * @var string
    */
    protected $table = 'news';

    /**
     * The list of fields that should be handled by Carbon
     *
     * @var Array
     */
    protected $dates = ['date'];


    /**
     * Get the Chapter record associated with the user.
     */
    public function chapter()
    {
        return $this->hasOne('App\Models\Chapters', 'id', 'chapter_id');
    }

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
        return route( 'admin.news.edit', array('id' => $this->id) );
    }
}
