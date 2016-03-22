<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\News as Model;

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
            'title' => $news->title,
            'content' => $news->content,
            'published' => (boolean) $news->is_published
        ];
    }
}