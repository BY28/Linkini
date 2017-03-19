<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ActivityRepository;
use App\Repositories\TagRepository;
use App\Repositories\SearchRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\EntrepriseRepository;
use App\Repositories\ProjectRepository;

class SearchController extends Controller
{

     protected $activityRepository;
     protected $tagRepository;
     protected $searchRepository;
     protected $categoryRepository;
     protected $entrepriseRepository;
     protected $projectRepository;
     protected $nbrPerPage = 9;

    public function __construct(ActivityRepository $activityRepository, TagRepository $tagRepository, CategoryRepository $categoryRepository, EntrepriseRepository $entrepriseRepository, ProjectRepository $projectRepository)
    {
        
        $this->activityRepository = $activityRepository;
        $this->tagRepository = $tagRepository;
        $this->categoryRepository = $categoryRepository;
        $this->entrepriseRepository = $entrepriseRepository;
        $this->projectRepository = $projectRepository;
    }

    public function search(Request $request)
    {
        $output = "";
        $inputs = $request->all();
        if($request->ajax())
        {	
        	if($request->input('filter') != "Projets")
        	{
	            $activities = $this->activityRepository->getSearchedActivities($inputs);
	        
	            if($activities)
	            {        
	                foreach ($activities as $activity) 
	                {
	                    /*$output .= '<li class="list-group-item list-group-item-linkable"><a href="'.route('entreprises.activityResults', $activity->activity_url).'">'.$activity->name.'</a></li>';*/
	                    $output .= '<li class="list-group-item list-group-item-linkable">'.$activity->name.'</li>';
	                }
	                $output .= "
	                <script>
	                    $(document).ready(function() {
	                    $('.list-group-item-linkable').on('click', function() {
	                        //window.location.href = $(this).data('link');
	                        // new window:
	                        //window.open($(this).data('link'));
	                        $('#search').val($(this).text());
	                        $('.search-results').empty();
	                    });
	                })
	                </script>
	                "
	                ;
                return Response($output);
	            }
	            else
	            {
	                return Response()->json(['no' => 'Not Found.']);
	            }
	        }
	        else
	        {
	        	$tags = $this->tagRepository->getSearchedTags($inputs);
	        
	            if($tags)
	            {        
	                foreach ($tags as $tag) 
	                {
	                    /*$output .= '<li class="list-group-item list-group-item-linkable"><a href="'.route('entreprises.activityResults', $activity->activity_url).'">'.$activity->name.'</a></li>';*/
	                    $output .= '<li class="list-group-item list-group-item-linkable">'.$tag->tag.'</li>';
	                }
	                $output .= "
	                <script>
	                    $(document).ready(function() {
	                    $('.list-group-item-linkable').on('click', function() {
	                        //window.location.href = $(this).data('link');
	                        // new window:
	                        //window.open($(this).data('link'));
	                        $('.main-input').val($(this).text());
	                        $('.search-results').empty();
	                    });
	                })
	                </script>
	                "
	                ;
                return Response($output);
	            }
	            else
	            {
	                return Response()->json(['no' => 'Not Found.']);
	            }
	        }
        }
    }

    public function postSearch(Request $request)
    {
    	if($request->input('filter') != 'Projets')
    	{
    		$activity = $this->activityRepository->getByName($request->input('search'));
    		$entreprises = $this->entrepriseRepository->getWithUserAndActivitiesForActivityPaginate($activity->activity_url, $this->nbrPerPage);
       		$links = $entreprises->render();
    		$categories = $this->categoryRepository->categories();

    		return view('entreprises.index', compact('entreprises', 'categories', 'links'))
        ->with('info', 'Résultats pour la recherche de l\'activité : ' . $activity->name);
    	}
    	else
    	{
            $tags = explode(',', $request->input('tags'));
    		//$tag = $this->tagRepository->getByName($request->input('tags-input'));
    		$projects = $this->projectRepository->getWithUserAndTagsForTagPaginate(/*$tag->tag*/$tags, $this->nbrPerPage);
       		$links = $projects->render();
    		$categories = $this->categoryRepository->categories();

    		return view('projects.index', compact('projects', 'categories', 'links'));/*
        ->with('info', 'Résultats pour la recherche du tag : ' . $tag->tag);*/
    	}
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
    }
}
