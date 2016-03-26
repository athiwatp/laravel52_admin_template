<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\User as mUser;

class User extends TransformerAbstract
{
    /**
     * Handle method for the transformer
     *
     * @param App\Models\Gallery model
     *
     * @return Array
    */
    public function transform(mUser $user)
    {
        return [
            'id' => (int) $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone
        ];
    }
}