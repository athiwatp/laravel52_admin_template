<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Chapters as Model;
use App\Helpers\File as cFile;

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
            'icon' => ( $chapter->icon ? cFile::getImagePathURL( $chapter->icon, 'box2' ) : '' ),
            'description' => $chapter->description,
            'pos' => (int) $chapter->pos,
            'active' => (boolean) $chapter->is_active
        ];
    }
}