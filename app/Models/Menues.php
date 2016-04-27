<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany('App\Models\Menues', 'linked_to', 'id')
            ->orderBy('pos');
    }

    /**
     * Returns parent for the linked item
     *
     * @return Object
    */
    public function parent_for_parent()
    {
        return $this->belongsTo('App\Models\Menues', 'linked_to', 'id');
    }

}
