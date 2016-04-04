<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\CustomerReviews as Model;

class CustomerReviews extends TransformerAbstract
{
    /**
     * Handle method for the transformer
     *
     * @param App\Models\CustomerReviews model
     *
     * @return Array
    */
    public function transform(Model $reviews)
    {
        return [
            'id' => (int) $reviews->id,
            'title' => $reviews->title,
            'date' => $reviews->date,
            'content' => $reviews->comment,
            'published' => (boolean) $reviews->is_published
        ];
    }
}