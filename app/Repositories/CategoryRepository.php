<?php

namespace App\Repositories;

use App\Category;

class CategoryRepository extends ResourceRepository
{

    protected $category;

    public function __construct(Category $category)
	{
		$this->model = $category;
	}

	public function categories()
	{
		return $this->model->get();
	}
}