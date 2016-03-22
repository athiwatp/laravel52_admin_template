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
            'published' => (boolean) $page->is_published
        ];
    }
}