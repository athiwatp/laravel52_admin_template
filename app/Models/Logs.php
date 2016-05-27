<?php

namespace App\Models;
use App\Models\Cadenzas;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{

    /**
     * The database table used by the model
     *
     * @var string
    */
    protected $table = 'logs';

    /**
     * Return the object which generates the log
    */
    public function object()
    {
        $object = $this->morphTo();
        // $result = array( 'title' => '', 'url' => '' );

        // if ( $object ) {
        //     $result['url'] = $object->getRelated()->editurl;
        //     $result['title'] = $object->getRelated()->title;

        //     if ( get_class( $object->getRelated() ) ==  'App\Models\Cadenzas' ) {
        //         $result['title'] = $object->getRelated()->description;
        //     }
        // }


        return $object;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
