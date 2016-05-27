<?php

namespace App\Http\Controllers\Core\Admin;

use Illuminate\Http\Request;
use App\Repositories\AnnouncementsRepository as Announces;
use App\Repositories\NewsRepository as News;
use App\Repositories\GalleryRepository as Gallery;
use App\Repositories\VideoNewsRepository as VideoNews;
use App\Repositories\LogsRepository;

use App\Http\Requests;
use App\Http\Controllers\Core\Controller;
use Auth, cTemplate, cBreadcrumbs, Lang;

class DashboardController extends AdminController
{
    /**
     *
     * @param App\Repositories\ResumeRepository
     * @param App\Repositories\VacanciesRepository
     *
     * @return void
     */
    public function __construct(
        Announces $announces,
        News $news,
        Gallery $gallery,
        VideoNews $videoNews
        )
    {
        $this->announces = $announces;
        $this->news      = $news;
        $this->gallery   = $gallery;
        $this->videoNews = $videoNews;
    }

    /**
     * Retrive the main page
    */
    public function index()
    {
        return cTemplate::createSimpleTemplate( $this->getTheme(), array(
            'sBreadcrumbs' => cBreadcrumbs::getItems( $this->getTheme(), array() ),
            'sTitle' => Lang::get('layouts.layouts.dashboard'),
            'sSubTitle' => '',
            'sBoxTitle' => '',
            'isShownSearchBox' => false,
            'sContent' => $this->renderView('user.dashboard', array(
                'countAnnounces' => $this->announces->getIndex()->count(),
                'countNews'      => $this->news->getIndex()->count(),
                'countGallery'   => $this->gallery->index()->count(),
                'countVideoNews' => $this->videoNews->getIndex()->count()
            ))
        ));
    }
}
