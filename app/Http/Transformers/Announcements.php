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
            'date' => get_formatted_date($announce->date_start) . ' / ' . get_formatted_date($announce->date_end),
            'image' => ( $announce->image ? cFile::getImagePathURL( $announce->image, 'box2' ) : '' ),
            'published' => (boolean) $announce->is_published,
            'important' => (boolean) $announce->important,
        ];
    }
}