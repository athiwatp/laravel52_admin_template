<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Menues as Model;

class Menues extends TransformerAbstract
{
    /**
     * Handle method for the transformer
     *
     * @param App\Models\Menues model
     *
     * @return Array
     */
    public function transform(Model $menu)
    {
        return [
            'id' => (int) $menu->id,
            'title' => $menu->title,
            'type' => $menu->type_menu,
            'pos' => (int) $menu->pos,
            'published' => (boolean) $menu->is_published,
            'default' => (boolean) $menu->is_loaded_by_default,
            'print' => (boolean) $menu->is_shown_print_version,
            'redirect' => (boolean) $menu->is_redirectable,
            'redirect_url' => $menu->redirect_url,
            'linked' => $menu->linked,
            'url' => $menu->url,
            'created' => $menu->created_at,
            'updated' => $menu->updated_at
        ];
    }
}