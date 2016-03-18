<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

    const TYPE_VIDEO = 'V';
    const TYPE_PHOTO = 'P';

    /**
     * The database table used by the model
     *
     * @var string
    */
    protected $table = 'gallery';
}
