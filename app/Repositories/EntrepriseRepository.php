<?php

namespace App\Repositories;

use App\Entreprise;

class EntrepriseRepository extends ResourceRepository
{

    protected $entreprise;

    public function __construct(Entreprise $entreprise)
	{
		$this->model = $entreprise;
	}

	public function store(Array $inputs)
	{
		$imgName = $this->moveImage($inputs['image'], config('imageBusiness.path'));

		if($imgName != '')
		{
			$inputs['image'] = $imgName;
			return $this->model->create($inputs);
		}
		
	}

	private function queryWithUserAndActivity()
	{
		return $this->model->with('user', 'activity')
		->orderBy('entreprises.created_at', 'desc');		
	}

	private function queryWithUserAndCategory()
	{
		return $this->model->with('user', 'category')
		->orderBy('entreprises.created_at', 'desc');		
	}

	public function getWithUserAndActivitiesForActivityPaginate($activity, $n)
	{
		return $this->queryWithUserAndActivity()
		->whereHas('activity', function($q) use ($activity)
		{
		  $q->where('activities.activity_url', $activity);
		})->paginate($n);
	}

	public function getWithUserAndCategoriesForCategoryPaginate($category, $n)
	{
		return $this->queryWithUserAndCategory()
		->whereHas('category', function($q) use ($category)
		{
		  $q->where('categories.category_url', $category);
		})->paginate($n);
	}
}