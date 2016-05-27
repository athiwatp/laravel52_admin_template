<?php

namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\GalleryRepository;
use Lang;

class GalleryController extends FaceController
{
    /**
     * Injected news repository object
     *
     * @var Object
     */
    protected $gallery = null;

    /**
     *
     */
    public function __construct(GalleryRepository $gallery)
    {
        // Call the parent controller first
        parent::__construct();

        // Implement here custom logic
        $this->gallery = $gallery;
    }

    /**
     * Retrive the gallery page
     */
    public function show(Request $request, $id)
    {
        $lGallery = $this->gallery->getById( $id );

        if ( $lGallery ) {
            return $this->renderView('gallery.show', [
                'gallery' => $lGallery,
                'aTitle'    => $lGallery->title
            ]);
        }

        return redirect()->route('home')
            ->with('status', Lang::get('table_field.page_was_not_found'));
    }

    /**
     * Output the list of photos
     *
     */
    public function index(Request $request)
    {
        $lGallery = $this->gallery->getPaginatedList( $request );

        return $this->renderView('gallery.index', [
            'gallery' => $lGallery,
            'aTitle'    => Lang::get('gallery.lists.gallery')
        ]);

    }
}
