<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Vacancies as Model;

class Vacancies extends TransformerAbstract
{
    /**
     * Handle method for the transformer
     *
     * @param App\Models\Vacancies model
     *
     * @return Array
     */
    public function transform(Model $vacancies)
    {
        return [
            'id' => (int) $vacancies->id,
            'title' => $vacancies->title,
            'employer' => $vacancies->employer,
            'city' => $vacancies->city,
        ];
    }
}