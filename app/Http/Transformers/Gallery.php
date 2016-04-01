<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Gallery as mGallery;
use App\Helpers\File as cFile;

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
            'filename' => ( $gallery->filename ? cFile::getImagePathURL( $gallery->filename, 'box2' ) : '' )
        ];
    }
}