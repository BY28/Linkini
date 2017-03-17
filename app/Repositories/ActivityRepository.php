<?php

namespace App\Repositories;

use App\Activity;
use Illuminate\Support\Str;

class ActivityRepository extends ResourceRepository
{

    protected $activity;

    public function __construct(Activity $activity)
	{
		$this->model = $activity;
	}

	public function store(Array $inputs)
	{
		$category_id = $inputs['category_id'];
		$activity = $inputs['name'];


		$activity_url = Str::slug($activity);

		$activity_ref = $this->model->where('activity_url', $activity_url)->first();

			if(is_null($activity_ref))
			{
				$activity_ref = new $this->model([
					'name' => $activity,
					'activity_url' => $activity_url,
					'category_id' => $category_id
				]);	

				$activity_ref->save();
			}

	}

	public function getByName($name)
	{
		return $this->model->where('name', $name)->first();
	}

	public function getByURL($slug)
	{
		return $this->model->where('activity_url', $slug)->first();
	}

	public function getSearchedActivities($inputs)
	{
		return $this->model->where('name', 'LIKE', '%'.$inputs['search'].'%')->get();
	}

}