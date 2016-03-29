<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrlHistory extends Model
{

    const TYPE_MENU = 'menu';
    const TYPE_NONE = 'none';
    const TYPE_PAGE = 'page';
    const TYPE_NEWS = 'news';


    /**
     * The database table used by the model
     *
     * @var string
    */
    protected $table = 'url_history';

}
