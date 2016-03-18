<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapters extends Model {


    const IS_ACTIVE = '1';
    const NOT_ACTIVE = '0';

    const TYPE_CHAPTER = '0';
    const TYPE_GALLERY = '1';

    /**
     * The database table used by the model
     *
     * @var string
    */
    protected $table = 'chapters';

}
