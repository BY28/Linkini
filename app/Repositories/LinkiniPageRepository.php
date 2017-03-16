<?php

namespace App\Repositories;

use App\LinkiniPage;
use App\PageCategory;

class LinkiniPageRepository extends ResourceRepository
{

    protected $linkiniPage;
    protected $pageCategory;

    public function __construct(LinkiniPage $linkiniPage, PageCategory $pageCategory)
	{
		$this->model = $linkiniPage;
		$this->pageCategory = $pageCategory;
	}

	public function get()
	{
		return $this->model->get();
	}

	public function store(Array $inputs)
	{
		$imgName = $this->moveImage($inputs['image'], config('imageLinkiniPage.path'));

		if($imgName != '')
		{
			$inputs['image'] = $imgName;
			return $this->model->create($inputs);
		}
		
	}

	public function getCategory($category)
	{
		return $this->pageCategory->where('name', $category)->first();
	}
}