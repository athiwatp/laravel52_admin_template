<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Config;

class Menues extends Model
{
    /**
     * The database table used by the model
     *
     * @var string
    */
    protected $table = 'static_menues';

    /**
     * Returns a list of linked items
     *
     * @return Array
    */
    public function linked()
    {
        return $this->hasMany('App\Models\MenuLinked', 'id_menu', 'id');
    }

    /**
     * Retrieve the parent for the linked menu
     *
    */
    public function parent_for_linked()
    {
        return $this->hasOne('App\Models\Menues', 'id','linked_to');
    }

    /**
     * Returns parent for the linked item
     *
     * @return Object
    */
    public function parent_for_parent()
    {
        return $this->belongsTo('App\Models\Menues', 'linked_to', 'id')
            ->where('is_published', Config::get('constants.DONE_STATUS.SUCCESS'));
    }

    /**
     * Custom attribute `linkedmenu`
    */
    public function getLinkedmenuAttribute()
    {
        $result = [];

        foreach ( $this->linked as $item ) {
            $result[] = $item->child;
        }

        if ( count($result) === 0 ) {
            if ( $menu = $this->parent_for_parent ) {
                foreach ( $menu->linked as $item ) {
                    $result[] = $item->child;
                }
            }
        }

        return $result;
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
        return route( 'admin.menu.edit', array('id' => $this->id) );
    }
}
