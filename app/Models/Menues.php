<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menues extends Model
{

    const TYPE_MAIN = 'M';
    const TYPE_SIDE = 'S';
    const TYPE_FOOTER = 'F';
    const TYPE_HIDDEN_PAGE = 'H';

    const IS_PUBLISHED = '1';
    const NOT_PUBLISHED = '0';

    /**
     * The database table used by the model
     *
     * @var string
    */
    protected $table = 'static_menues';

}
