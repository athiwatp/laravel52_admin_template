<?php

namespace App\Models;

use Sofa\Eloquence\Eloquence;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{

    use Eloquence;

    /**
     * The database table used by the model
     *
     * @var string
    */
    protected $table = 'static_pages';

    /**
     * Seachable columns
     *
     * @var Array
    */
    protected $searchableColumns = ['title', 'subtitle', 'content'];

    /**
     * Get the menu that owns the page
     */
    public function menu()
    {
        return $this->belongsTo('App\Models\Menues', 'id', 'page_id');
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
        return route( 'admin.pages.edit', array('id' => $this->id) );
    }
}
