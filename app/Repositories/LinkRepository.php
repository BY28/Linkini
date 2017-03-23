<?php

namespace App\Repositories;

use App\Link;
use App\Notification;
use App\Project;
use App\LinkOrder;

class LinkRepository extends ResourceRepository
{

    protected $link;
    protected $notification;
    protected $linkOrder;

    public function __construct(Link $link, Notification $notification, LinkOrder $linkOrder)
	{
		$this->model = $link;
		$this->notification = $notification;
		$this->linkOrder = $linkOrder;
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

		$amount = $inputs['amount'];
		$time = $inputs['time'];
		$informations = $inputs['informations'];

		$link = $this->model->where('entreprise_id', $entreprise->id)->where('project_id', $project->id)->where('accepted', false)->where('refused', false)->first();
		if(!$link)
		{
	    	$data = [
	    		'project_id' => $project->id,
	    		'entreprise_id' => $entreprise->id,
	    		'user_id' => $user_id,
	    		'amount' => $amount,
	    		'time' => $time,
	    		'informations' => $informations
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
	    		'user_id' => $entreprise->user->id,
	    		'project_id' => $project->id,
	    		'title' => 'Demande envoyée',
	    		'content' => 'Une demande d\'attribution a déjà été envoyée pour le projet '. $project->title .'.'
	    	];

		}

	   	$this->notification->create($data);

	}

	public function projectUnLink($inputs)
	{
		$project = Project::where('id', $inputs['projectId'])->first();
		$user_id = $project->user->id;

		$entreprise = $inputs['entreprise'];

		//$link = $this->model->where('entreprise_id', $entreprise->id)->where('project_id', $project->id)->where('refused', false)->first();
		$link = $this->getById($inputs['linkid']);

		if($link->entreprise->id == $entreprise->id)
		{
			if(!$link->accepted && !$link->refused && !$link->confirmed)
			{
				$updateData = [
		    		'refused' => true
		    	];

				$link->update($updateData);

				$data = [
		    		'user_id' => $user_id,
		    		'project_id' => $project->id,
		    		'title' => 'Annulation de lien',
		    		'content' => 'L\'entreprise '. $entreprise->name . ' a annulé la demande de travailler avec vous sur le projet '. $project->title .'.'
		    	];
		    		$this->notification->create($data);
			}
			/*else if($link->accepted && $link->refused)
			{
				$data = [
		    		'user_id' => $entreprise->id,
		    		'project_id' => $project->id,
		    		'title' => 'Annulation de lien',
		    		'content' => 'Le projet '. $project->title .' a été annulé.'
		    	];
			}
			else if(!$link->accepted && $link->refused)
			{

				$data = [
		    		'user_id' => $entreprise->id,
		    		'project_id' => $project->id,
		    		'title' => 'Annulation de lien',
		    		'content' => 'La demande pour le projet '. $project->title .' a déjà été annulé.'
		    	];
			}*/
			else if($link->accepted && !$link->refused && !$link->confirmed)
			{
				$updateData = [
		    		'refused' => true
		    	];

				$link->update($updateData);

				$link->project->launched = false;

				$link->project->save();

				$data = [
		    		'user_id' => $user_id,
		    		'project_id' => $project->id,
		    		'title' => 'Annulation de lien',
		    		'content' => 'L\'entreprise '. $entreprise->name . ' a annulé le projet en cours '. $project->title .'.'
		    	];

		    		$this->notification->create($data);
			}

		}

	   

	}

	public function attributionAccept($link)
	{
		$entreprise = $link->entreprise;
		$project = $link->project;

		if(!$link->refused && !$link->accepted && !$link->project->launched)
		{
			$link->accepted = true;
			$link->project->launched = true;

			$link->project->save();
			$link->save();

			$data = [
		    		'user_id' => $entreprise->id,
		    		'project_id' => $project->id,
		    		'title' => 'Annulation de lien',
		    		'content' => 'La demande d\'attribution pour le projet '. $project->title .' a été acceptée.'
		    	];

		   	$this->notification->create($data);
		}
		/*else if($link->project->launched)
		{
			$data = [
		    		'user_id' => $project->user->id,
		    		'project_id' => $project->id,
		    		'title' => 'Annulation de lien',
		    		'content' => 'Le projet '. $project->title .' est déjà lancé.'
		    	];
		}
		else if($link->accepted && $link->refused)
		{
			$data = [
		    		'user_id' => $project->user->id,
		    		'project_id' => $project->id,
		    		'title' => 'Annulation de lien',
		    		'content' => 'Le projet '. $project->title .' a été annulé.'
		    	];
		}
		else
		{
			$data = [
		    		'user_id' => $project->user->id,
		    		'project_id' => $project->id,
		    		'title' => 'Annulation de lien',
		    		'content' => 'La demande d\'attribution pour le projet '. $project->title .' a été annulé.'
		    	];
		}*/
		
		
	}

	public function attributionCancel($link)
	{
		$entreprise = $link->entreprise;
		$project = $link->project;

		if(!$link->refused && !$link->confirmed)
		{
			$link->refused = true;
			$link->project->launched = false;
			$link->save();
			$link->project->save();

			$data = [
		    		'user_id' => $project->user->id,
		    		'project_id' => $project->id,
		    		'title' => 'Annulation de lien',
		    		'content' => 'Le project en cours '. $project->title .' a été annulé.'
		    	];

		    $this->notification->create($data);

		    $data = [
		    		'user_id' => $entreprise->id,
		    		'project_id' => $project->id,
		    		'title' => 'Annulation de lien',
		    		'content' => 'Le project en cours '. $project->title .' a été annulé.'
		    	];

		    $this->notification->create($data);
		}
		
	}

	public function attributionConfirm($link)
	{
		$entreprise = $link->entreprise;
		$project = $link->project;

		if(!$link->refused && !$link->confirmed && $link->accepted && $link->project->launched)
		{
			$link->confirmed = true;
			$link->save();

			$data = [
		    		'user_id' => $project->user->id,
		    		'project_id' => $project->id,
		    		'title' => 'Annulation de lien',
		    		'content' => 'Le project en cours '. $project->title .' a été confirmé.'
		    	];

		    $this->notification->create($data);
		}
		
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

	public function getAttributionProjects($entreprise_id)
	{
		return $this->model->where('entreprise_id', $entreprise_id)->where('accepted', false)->where('refused', false)->orderBy('created_at', 'desc')->get();
	}

	public function getLaunchedProjects($entreprise_id)
	{
		return $this->model->where('accepted', true)->where('entreprise_id', $entreprise_id)->where('refused', false)->orderBy('created_at', 'desc')->get();
	}

	public function getCanceledProjects($entreprise_id)
	{
		return $this->model->where('entreprise_id', $entreprise_id)->where('refused', true)->orderBy('created_at', 'desc')->get();
	}

	public function getUserAttributionProjects($user_id)
	{
		return $this->model->where('user_id', $user_id)->where('accepted', false)->where('refused', false)->orderBy('created_at', 'desc')->get();
	}

	public function getUserLaunchedProjects($user_id)
	{
		return $this->model->where('user_id', $user_id)->where('accepted', true)->where('refused', false)->orderBy('created_at', 'desc')->get();
	}

	public function getProjectsCanceled($user_id)
	{
		return $this->model->where('user_id', $user_id)->where('refused', true)->orderBy('created_at', 'desc')->get();
	}

	public function getLinkid($entreprise_id, $project_id)
	{
		$link = $this->model->where('entreprise_id', $entreprise_id)->where('project_id', $project_id)->where('refused', false)->where('confirmed', false)->first();
		if($link)
			return $link->id;
		else
			return false;
	}
}