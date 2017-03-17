<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ActivityRepository;

class ActivityController extends Controller
{

     protected $activityRepository;

    public function __construct(ActivityRepository $activityRepository)
    {
        $this->middleware('auth');
        $this->middleware('admin');
        
        $this->activityRepository = $activityRepository;
    }

    public function search(Request $request)
    {
        $output = "";
        $inputs = $request->all();
        if($request->ajax())
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
        $this->activityRepository->store($request->all());
        
        return redirect()->route('activities.index', $request->input('category_id'));
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
        $id = $request->input('activityId');
        $inputs['name'] = $request->input('activityName');
        $this->activityRepository->update($id, $inputs);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('activityId');
        $this->activityRepository->destroy($id);
    }
}
