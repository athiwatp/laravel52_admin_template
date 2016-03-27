<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\User as Model;

class Users extends TransformerAbstract
{
    /**
     * Handle method for the transformer
     *
     * @param App\Models\Users model
     *
     * @return Array
     */
    public function transform(Model $user)
    {
        return [
            'id' => (int) $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'is_admin' => (boolean) $user->is_admin,
            'is_verified' => (boolean) $user->is_verified,
            'created' => $user->created_at,
            'updated' => $user->updated_at,
        ];
    }
}