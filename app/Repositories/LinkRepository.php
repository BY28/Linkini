<?php

namespace App\Repositories;

use App\Link;
use App\User;
use App\Project;

class LinkRepository extends ResourceRepository
{

    protected $link;

    public function __construct(Link $link)
	{
		$this->model = $link;
	}

	public function getLinks($user)
    {
    	if($user->entreprise != null)
    	{
    			 return $this->model->where('user_id', $user->id)->orWhere('entreprise_id', $user->entreprise->id)->orderBy('created_at', 'desc')->get();
    	}
        return $this->model->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
    }

	public function projectLink($inputs)
	{
		//$user = User::where('id', $inputs['user_id'])->first();
		$project = Project::where('id', $inputs['projectId'])->first();
		//$entreprise_id = $user->entreprise->id;
		$user_id = $project->user->id;

		$user = $inputs['user'];
    	$data = [
    		'project_id' => $project->id,
    		'entreprise_id' => $user->id,
    		'user_id' => $user_id
    	];

    	$this->store($data);
	}

	public function accept($inputs)
	{
		$link = $this->getById($inputs['linkId']);

		$link->accepted = true;

		$link->save();
	}

	public function refuse($inputs)
	{
		$link = $this->getById($inputs['linkId']);

		$link->refused = true;

		$link->save();
	}
}