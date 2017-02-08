<?php

namespace App\Repositories;

use App\Project;

class ProjectRepository extends ResourceRepository
{

    protected $project;

    public function __construct(Project $project)
	{
		$this->model = $project;
	}

	private function queryWithUserAndTags()
	{
		return $this->model->with('user', 'tags')
		->orderBy('projects.created_at', 'desc');		
	}

	public function getPaginate($n)
	{
		return $this->queryWithUserAndTags()->paginate($n);
	}

	public function getWithUserAndTagsForTagPaginate($tag, $n)
	{
		return $this->queryWithUserAndTags()
		->whereHas('tags', function($q) use ($tag)
		{
		  $q->where('tags.tag_url', $tag);
		})->paginate($n);
	}

	public function destroy($id)
	{
		$project = $this->model->findOrFail($id);
		$project->tags()->detach();
		$project->delete();
	}
	/*
		*
		* PAS DE SURCHARGE POUR LE MOMENT
		*
	public function store(Array $inputs)
	{
		$imgName = $this->moveImage($inputs['image'], config('imageProject.path'));

		if($imgName != '')
		{
			$inputs['image'] = $imgName;
			return $this->model->create($inputs);
		}
		
	}
	*/
}