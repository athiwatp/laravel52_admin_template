<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Announcements as Model;

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
            'date_start' => $announce->date_start,
            'date_end' => $announce->date_end,
            'image' => $announce->image,
            'published' => (boolean) $announce->is_published,
            'important' => (boolean) $announce->important,
        ];
    }
}