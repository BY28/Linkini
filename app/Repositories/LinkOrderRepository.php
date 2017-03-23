<?php

namespace App\Repositories;

use App\LinkOrder;
use App\Link;
use App\Notification;

class LinkOrderRepository extends ResourceRepository
{

    protected $linkOrder;
    protected $link;
    protected $activity;
    protected $notification;

    public function __construct(LinkOrder $linkOrder, Link $link, Notification $notification)
	{
		$this->model = $linkOrder;
		$this->link = $link;
		$this->notification = $notification;
	}

	public function getPendingProjects($entreprise_id)
	{
		return $this->model->where('entreprise_id', $entreprise_id)->orderBy('created_at', 'desc')->get();
	}

	public function linkOrder($inputs)
	{
		$project = $inputs['project'];
		$user_id = $project->user->id;

		$entreprise = $inputs['entreprise'];

		$link = $this->model->where('entreprise_id', $entreprise->id)->where('project_id', $project->id)->first();
		if(!$link)
		{
			if(!$project->launched)
			{
		    	$data = [
		    		'project_id' => $project->id,
		    		'entreprise_id' => $entreprise->id,
		    		'user_id' => $user_id
		    	];

		    	$this->store($data);

		    	$data = [
		    		'user_id' => $entreprise->user->id,
		    		'project_id' => $project->id,
		    		'title' => 'Demande de lien',
		    		'content' => 'L\'utilisateur '. $project->user->email . ' demande à travailler avec vous sur le projet '. $project->title .'.'
		    	];
			}
			else
			{
				$data = [
		    		'user_id' => $user_id,
		    		'project_id' => $project->id,
		    		'title' => 'Demande de lien',
		    		'content' => 'Le projet '.$project->title .' est déjà en cours vous ne pouvez pas envoyer de notifications.'
		    	];
			} 
		
		}
		else
		{
			/*$this->model->destroy($link->id);

			$data = [
	    		'user_id' => $user_id,
	    		'project_id' => $project->id,
	    		'title' => 'Annulation de lien',
	    		'content' => 'L\'entreprise '. $entreprise->name . ' a annulé la demande de travailler avec vous sur le projet '. $project->title .'.'
	    	];
	    	*/
	    	$data = [
	    		'user_id' => $user_id,
	    		'project_id' => $project->id,
	    		'title' => 'Notification envoyée',
	    		'content' => 'Une notification a déjà été envoyée à l\'entreprise'.$entreprise->name.' pour le projet'.$project->title.'.'
	    	];
		}

	   	$this->notification->create($data);

	}

	public function unlinkOrder($inputs)
	{

		$link = $this->getById($inputs['linkid']);

		//$project = $link->project;
		//$user_id = $project->user->id;

		$entreprise = $inputs['entreprise'];

		if($link->entreprise->id == $entreprise->id)
		{
			$this->destroy($link->id);

			/*$data = [
	    		'user_id' => $user_id,
	    		'project_id' => $project->id,
	    		'title' => 'Annulation de lien',
	    		'content' => 'L\'entreprise '. $entreprise->name . ' n\'a pas effectué de demande d\'attribution suite à votre notification sur le projet '. $project->title .'.'
	    	];*/

		}

	   	//$this->notification->create($data);
	}

}