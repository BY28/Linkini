<?php

namespace App\Http\Controllers;

use App\Repositories\ProjectRepository;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $projectRepository;
    protected $nbrPerPage = 12;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        //$this->middleware('auth');
        $this->projectRepository = $projectRepository;
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
        
        return view('home', compact('projects', 'links'));
    }
}
