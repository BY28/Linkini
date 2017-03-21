<?php

namespace App\Repositories;

use App\Link;
use App\Notification;
use App\Project;

class LinkRepository extends ResourceRepository
{

    protected $link;
    protected $notification;

    public function __construct(Link $link, Notification $notification)
	{
		$this->model = $link;
		$this->notification = $notification;
	}

	public function notifications($user)
	{
		$notifications = $user->notifications->reverse();
		return $notifications;
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
		$project = Project::where('id', $inputs['projectId'])->first();
		$user_id = $project->user->id;

		$entreprise = $inputs['entreprise'];

		$link = $this->model->where('entreprise_id', $entreprise->id)->where('project_id', $project->id)->first();
		if(!$link)
		{
	    	$data = [
	    		'project_id' => $project->id,
	    		'entreprise_id' => $entreprise->id,
	    		'user_id' => $user_id
	    	];

	    	$this->store($data);

	    	$data = [
	    		'user_id' => $user_id,
	    		'project_id' => $project->id,
	    		'title' => 'Demande de lien',
	    		'content' => 'L\'entreprise '. $entreprise->name . ' demande à travailler avec vous sur le projet '. $project->title .'.'
	    	];
		}
		else
		{
			$this->model->destroy($link->id);

			$data = [
	    		'user_id' => $user_id,
	    		'project_id' => $project->id,
	    		'title' => 'Annulation de lien',
	    		'content' => 'L\'entreprise '. $entreprise->name . ' a annulé la demande de travailler avec vous sur le projet '. $project->title .'.'
	    	];

		}

	   	$this->notification->create($data);

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

	public function checkSeen($user, $id)
	{
		$notifications = Notification::where('user_id', $user->id)->where('project_id', $id)->get();

		if($notifications != null)
		{	
			foreach ($notifications as $notification)
			{	
				if(!$notification->seen)
				{
					$notification->seen = true;
					$notification->save();
				}
			}
		}
	}

	public function getEntreprisePendingProjects($entreprise_id)
	{
		return $this->model->where('accepted', 0)->where('entreprise_id', $entreprise_id)->orderBy('created_at', 'desc')->get();
	}

}