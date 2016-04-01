<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\News as Model;
use App\Helpers\File as cFile;


class News extends TransformerAbstract
{
    /**
     * Handle method for the transformer
     *
     * @param App\Models\News model
     *
     * @return Array
    */
    public function transform(Model $news)
    {
        return [
            'id' => (int) $news->id,
            'date' => $news->date,
            'title' => $news->title,
            'content' => $news->content,
            'published' => (boolean) $news->is_published,
            'main' => (boolean) $news->is_main,
            'important' => (boolean) $news->is_important,
            'photo' => ( $news->photo ? cFile::getImagePathURL( $news->photo, 'box2' ) : '' )
        ];
    }
}