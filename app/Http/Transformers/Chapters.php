<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Chapters as Model;

class Chapters extends TransformerAbstract
{
    /**
     * Handle method for the transformer
     *
     * @param App\Models\Chapters model
     *
     * @return Array
     */
    public function transform(Model $chapter)
    {
        return [
            'id' => (int) $chapter->id,
            'title' => $chapter->title,
            'description' => $chapter->description,
            //'published' => (boolean) $chapter->is_published
        ];
    }
}