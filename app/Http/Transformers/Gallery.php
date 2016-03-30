<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Gallery as mGallery;

class Gallery extends TransformerAbstract
{
    /**
     * Handle method for the transformer
     *
     * @param App\Models\Gallery model
     *
     * @return Array
    */
    public function transform(mGallery $gallery)
    {
        return [
            'id' => (int) $gallery->id,
            'title' => $gallery->title,
            'filename' => url($gallery->filename)
        ];
    }
}