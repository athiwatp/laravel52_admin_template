<?php namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\AnnouncementsRepository;

class AnnouncementsController extends FaceController
{
    /**
     * Injected news repository object
     *
     * @var Object
     */
    protected $announce = null;

    /**
     *
     */
    public function __construct(AnnouncementsRepository $announce)
    {
        $this->announce = $announce;
    }
}