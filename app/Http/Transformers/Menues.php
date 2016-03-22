<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Menues as Model;

class Menues extends TransformerAbstract
{
    /**
     * Handle method for the transformer
     *
     * @param App\Models\Menues model
     *
     * @return Array
     */
    public function transform(Model $menu)
    {
        return [
            'id' => (int) $menu->id,
            'title' => $menu->title
        ];
    }
}