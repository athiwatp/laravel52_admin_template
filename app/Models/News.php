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

}
