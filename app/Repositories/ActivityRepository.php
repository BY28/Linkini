<?php

namespace App\Repositories;

use App\Activity;

class ActivityRepository extends ResourceRepository
{

    protected $activity;

    public function __construct(Activity $activity)
	{
		$this->model = $activity;
	}

	public function getByName($name)
	{
		return $this->model->where('name', $name)->first();
	}
}