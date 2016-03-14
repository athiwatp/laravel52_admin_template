<?php namespace App\Repositories;

use App\Models\Menus as Menus;
use Carbon\Carbon;

class MenusRepository extends BaseRepository {
    /**
     * Create a new Message instance
     *
     * @param App\Models\Menus $menus
     *
     * @return void
    */
    public function __construct(Menus $menus)
    {
        $this->model = $menus;
    }

        /**
     * Create or update Message
     *
     * @param App\Models\Menus $menus
     *
     * @return
    */
    public function index()
    {
        return $this->model->all();
    }

    /**
     * Create or update Message
     *
     * @param App\Models\Menus $menus
     *
     * @return
    */
    public function saveMenus( $menu, $inputs )
    {
        $menu->title        = $inputs['title'];
        $menu->parent_id    = ( isset($inputs['parent_id']) ? $inputs['parent_id'] : null );
        $menu->path         = ( isset($inputs['path']) ? $inputs['path'] : null );
        $menu->pos          = ( isset($inputs['pos']) ? $inputs['pos'] : 0 );
        $menu->type_menu    = ( isset($inputs['type_menu']) ? $inputs['type_menu'] : 0 );
        $menu->page_id      = ( isset($inputs['page_id']) ? $inputs['page_id'] : null );
        $menu->url          = $inputs['url'];
        $menu->redirect_url = ( isset($inputs['redirect_url']) ? $inputs['redirect_url'] : null );
        $menu->user_id      = 1/*Auth::id()*/;
        $menu->is_published           = $inputs['is_published'];
        $menu->is_redirectable        = ( isset($inputs['is_redirectable']) ? $inputs['is_redirectable'] : 0 );
        $menu->is_loaded_by_default   = ( isset($inputs['is_loaded_by_default']) ? $inputs['is_loaded_by_default'] : 0);
        $menu->is_shown_print_version = ( isset($inputs['is_shown_print_version']) ? $inputs['is_shown_print_version'] : 0 );

        $menu->save();

        return true;
    }

    /**
     * Create a message
     *
     * @param array $inputs
     * @param int $user_id
     *
     * @return void
    */
    public function store( $inputs )
    {
        $id = $inputs['id'];

        if ( isset($id) && $id > 0 ) {
            $model = $this->model->find( $id );
        } else {
            $model = new $this->model;
        }

        $menus = $this->saveMenus( $model, $inputs );

        // some post creation actions will be required
    }

    /**
     * Edit or update Message
     *
     * @param App\Models\Menus $menus
     *
     * @return
    */
    public function edit( $id )
    {
        return $this->model->find($id);
    }

    /**
     * Destroy a message
     *
     * @param App\Models\Menus
     *
     * @return void
    */
    public function destroy($id)
    {
        $this->model->delete($id);
    }
}
