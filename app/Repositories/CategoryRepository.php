<?php

namespace App\Repositories;

use App\Category;
use Illuminate\Support\Str;

class CategoryRepository extends ResourceRepository
{

    protected $category;

    public function __construct(Category $category)
	{
		$this->model = $category;
	}


	public function store(Array $inputs)
	{

		$category = $inputs['name'];


		$category_url = Str::slug($category);

		$category_ref = $this->model->where('category_url', $category_url)->first();

			if(is_null($category_ref))
			{
				$category_ref = new $this->model([
					'name' => $category,
					'category_url' => $category_url
				]);	

				$category_ref->save();
			}

	}

	public function categories()
	{
		return $this->model->get();
	}

	public function getByName($name)
	{
		return $this->model->where('name', $name)->first();
	}

	public function getByURL($slug)
	{
		return $this->model->where('category_url', $slug)->first();
	}
}