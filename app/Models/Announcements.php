<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcements extends Model
{
    /**
     * The database table used by the model
     *
     * @var string
    */
    protected $table = 'announcement';

    /**
     * Get the Chapter record associated with the user.
     */
    public function chapter()
    {
        return $this->hasOne('App\Models\Chapters', 'id', 'chapter_id');
    }
}
