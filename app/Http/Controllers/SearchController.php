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
        	if($request->input('filter') == "Secteur d'activité")
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
	        else if($request->input('filter') == "Projets" || $request->input('filter') == "Tags")
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
    	if($request->input('filter') == "Secteur d'activité")
    	{
    		return $this->searchActivities($request);
    	}
    	else if($request->input('filter') == "Projets" || $request->input('filter') == "Tags")
    	{
            return $this->searchTags($request);
    	}
        else if($request->input('filter') == "Titre/Description")
        {
            return $this->searchProjectsTitle($request);
        }
        else if($request->input('filter') == "Nom/Description")
        {
            return $this->searchEntreprisesName($request);
        }
    }

    public function searchActivities($request)
    {
        $activity = $this->activityRepository->getByName($request->input('search'));
        if($activity)    
        {
            return redirect()->route('entreprises.activityResults', $activity->activity_url);
        }
        else
        {
            return redirect()->route('entreprises.activityResults', $request->input('search'));
        }
    }

    public function searchTags($request)
    {
        $tags = explode(',', $request->input('tags'));

        return redirect()->route('projects.tagResults', $tags);
    }

     public function searchProjectsTitle($request)
    {
            $query = $request->input('search');
            
             return redirect()->route('projects.titleResults', $query);
    }

     public function searchEntreprisesName($request)
    {
            $query = $request->input('name');
            
             return redirect()->route('entreprises.nameResults', $query);
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
