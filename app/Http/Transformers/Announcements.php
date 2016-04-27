<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Announcements as Model;
use App\Helpers\File as cFile;

class Announcements extends TransformerAbstract
{
    /**
     * Handle method for the transformer
     *
     * @param App\Models\Announcements model
     *
     * @return Array
     */
    public function transform(Model $announce)
    {
        return [
            'id' => (int) $announce->id,
            'title' => $announce->title,
            'content' => $announce->description,
            'date_start' => $announce->date_start,
            'date_end' => $announce->date_end,
            'top_date_end' => $announce->top_date_end,
            'actual' => $announce->is_topical,
            'image' => ( $announce->image ? cFile::getImagePathURL( $announce->image, 'box2' ) : '' ),
            'published' => (boolean) $announce->is_published,
            'important' => (boolean) $announce->important,
        ];
    }
}