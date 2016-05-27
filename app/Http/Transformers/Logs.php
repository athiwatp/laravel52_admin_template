<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Logs as Model;
use Lang;

class Logs extends TransformerAbstract
{
    /**
     * Handle method for the transformer
     *
     * @param App\Models\Logs model
     *
     * @return Array
    */
    public function transform(Model $log)
    {
        $object = $log->object;
        $result = array( 'title' => '', 'url' => '' );

        if ( $object ) {
            $result['url'] = $object->editurl;
            $result['title'] = $object->title;

            if ( get_class( $object ) ==  'App\Models\Cadenzas' ) {
                $result['title'] = $object->description;
            } elseif ( get_class( $object ) ==  'App\Models\Deputy' ) {
                $result['title'] = $object->full_name;
            } elseif ( get_class( $object ) ==  'App\Models\Subscribers' ) {
                $result['title'] = $object->email;
            } elseif ( get_class( $object ) ==  'App\Models\User' ) {
                $result['title'] = $object->name;
            }
        }
        $result = (object) $result;

        return [
            'date'    => $log->created_at,
            'comment' => $log->comment,
            'related_object'  => $result,
            'user' => $log->user
        ];
    }
}