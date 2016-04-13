<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Subscribers as Model;

class Subscribers extends TransformerAbstract
{
    /**
     * Handle method for the transformer
     *
     * @param App\Models\Subscribers model
     *
     * @return Array
    */
    public function transform(Model $subscribers)
    {
        return [
            'id' => (int) $subscribers->id,
            'email' => $subscribers->email,
            'active' => (boolean) $subscribers->is_active
        ];
    }
}