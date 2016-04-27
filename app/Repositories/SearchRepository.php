<?php namespace App\Repositories;

use Hash;
use App\Repositories\PagesRepository;

class SearchRepository extends BaseRepository {

    protected $pages = null;

    /**
     * Create a new Message instance
     *
     * @param App\Models\User $user
     *
     * @return void
     */
    public function __construct(PagesRepository $pages)
    {
        // Inject the page repository
        $this->pages = $pages;
    }

    /**
     *
    */
    public function get( $keywords )
    {
        return $this->pages->search( $keywords )
            ->paginate( $this->paginationAmount );
    }
}
