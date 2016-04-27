<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\UsefulLinks as Model;

class UsefulLinks extends TransformerAbstract
{
    /**
     * Handle method for the transformer
     *
     * @param App\Models\UsefulLinks model
     *
     * @return Array
    */
    public function transform(Model $link)
    {
        return [
            'id' => (int) $link->id,
            'title' => $link->title,
            'url' => $link->url,
            'active' => (boolean) $link->is_active
        ];
    }
}