<?php

namespace App\Repositories;

use App\Project;
use App\ProjectImage;

use File;

class ProjectRepository extends ResourceRepository
{

    protected $project;
    protected $projectImage;

    public function __construct(Project $project, ProjectImage $projectImage)
	{
		$this->model = $project;
		$this->projectImage = $projectImage;
	}

	private function queryWithUserAndTags()
	{
		return $this->model->where('launched', false)->with('user', 'tags')
		->orderBy('projects.created_at', 'desc');		
	}
	// Récuperation des projets
	public function getPaginate($n)
	{
		return $this->queryWithUserAndTags()->paginate($n);
	}

	public function getWithUserAndTagsForTagPaginate($tag, $n)
	{
		return $this->queryWithUserAndTags()
		->whereHas('tags', function($q) use ($tag)
		{
		  $q->whereIn('tags.tag', $tag);
		})->paginate($n);
	}

	public function destroy($id)
	{
		$project = $this->model->findOrFail($id);
		$project->tags()->detach();
		$project->delete();
	}

	public function getPending()
	{
		return $this->model->where('launched', 0)->orderBy('created_at', 'desc')->get();		
	}

	public function getLaunched()
	{
		return $this->model->where('launched', 1)->orderBy('created_at', 'desc')->get();
	}

	public function launch($inputs)
	{
		$project = $this->getById($inputs['projectId']);

		$project->launched = true;

		$project->save();

	}

	private function queryWithUserAndCategory()
	{
		return $this->model->where('launched', false)->with('user', 'category')
		->orderBy('projects.created_at', 'desc');		
	}

	public function getWithUserAndCategoriesForCategoryPaginate($category, $n)
	{
		return $this->queryWithUserAndCategory()
		->whereHas('category', function($q) use ($category)
		{
		  $q->where('categories.category_url', $category);
		})->paginate($n);
	}

	public function getProjectsFromTitle($query, $n)
	{
		return $this->model->where('launched', false)->where('title', 'LIKE', '%'.$query.'%')->orWhere('content', 'LIKE', '%'.$query.'%')->paginate($n);
	}

	public function getUserProjects($user_id)
	{
		return $this->model->where('user_id', $user_id)->get();
	}

	public function storeImage($inputs)
	{
		$this->projectImage->create($inputs);
	}

	public function deleteImage($id)
	{
		$image = $this->projectImage->findOrFail($id);

		if($image)
		{
			File::delete("uploads/project_images/" . $image->image);
			$image->delete();
		}

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