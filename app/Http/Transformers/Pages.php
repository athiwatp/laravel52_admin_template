<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Pages as Model;

class Pages extends TransformerAbstract
{
    /**
     * Handle method for the transformer
     *
     * @param App\Models\Pages model
     *
     * @return Array
     */
    public function transform(Model $page)
    {
        return [
            'id' => (int) $page->id,
            'title' => $page->title,
            'subtitle' => $page->subtitle,
            'url' => $page->url,
            'created' => $page->created_at,
            'updated' => $page->updated_at,
            'content' => $page->content,
            'meta_keywords' => $page->meta_keywords,
            'meta_description' => $page->meta_description,
            'published' => (boolean) $page->is_published,
        ];
    }
}