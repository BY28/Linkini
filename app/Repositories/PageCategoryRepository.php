<?php

namespace App\Repositories;

use App\PageCategory;
use Illuminate\Support\Str;

class PageCategoryRepository extends ResourceRepository
{

    protected $category;

    public function __construct(PageCategory $category)
	{
		$this->model = $category;
	}


	public function getByName($name)
	{
		return $this->model->where('name', $name)->first();
	}
}