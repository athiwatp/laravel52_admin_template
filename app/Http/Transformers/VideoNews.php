<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\VideoNews as mVideoNews;
use cScreenshot;

class VideoNews extends TransformerAbstract
{
    /**
     * Handle method for the transformer
     *
     * @param App\Models\VideoNews model
     *
     * @return Array
    */
    public function transform(mVideoNews $videoNews)
    {
        return [
            'id' => (int) $videoNews->id,
            'title' => $videoNews->title,
            'date' => $videoNews->date,
            'content' => $videoNews->content,
            'created' => $videoNews->created_at,
            'updated' => $videoNews->updated_at,
            'published' => (boolean) $videoNews->is_published,
            'preview' => cScreenshot::getItems($videoNews->youtube_url)
        ];
    }
}