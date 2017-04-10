<?php

namespace App\Http\Controllers;

use App\Repositories\ProjectRepository;
use App\Repositories\LinkiniPageRepository;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $projectRepository;
    protected $nbrPerPage = 12;

    protected $pageRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProjectRepository $projectRepository, LinkiniPageRepository $pageRepository)
    {
        //$this->middleware('auth');
        $this->projectRepository = $projectRepository;
        $this->pageRepository = $pageRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = $this->projectRepository->getPaginate($this->nbrPerPage);
        $links = $projects->render();

         $carouselImages = $this->pageRepository->getAdvertisements();
        
        return view('home', compact('projects', 'links', 'carouselImages'));
    }
}
