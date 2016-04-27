<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsefulLinks extends Model
{

    /**
     * The database table used by the model
     *
     * @var string
    */
    protected $table = 'useful_links';

    /**
     * Get the Chapter record associated with the user.
     */
    public function chapter()
    {
        return $this->hasOne(Chapters::class, 'id', 'chapter_id');
    }
}
