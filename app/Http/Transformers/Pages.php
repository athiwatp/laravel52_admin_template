<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Pages as mPages;

class Pages extends TransformerAbstract
{
    /**
     * Handle method for the transformer
     *
     * @param App\Models\Pages model
     *
     * @return Array
    */
    public function transform(mPages $page)
    {
        return [
            'id' => (int) $page->id,
            'title' => $page->title,
            'published' => $page->is_published
        ];
    }
}