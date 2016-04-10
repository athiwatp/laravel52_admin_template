<?php

namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\GalleryRepository;

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
                'gallery' => $lGallery
            ]);
        }

        return redirect()->route('home')
            ->with('status', 'Страница - не найдена!');
    }

    /**
     * Output the list of photos
     *
     */
    public function index(Request $request)
    {
        $lGallery = $this->gallery->getPaginatedList( $request );

        return $this->renderView('gallery.index', [
            'gallery' => $lGallery
        ]);

    }
}
