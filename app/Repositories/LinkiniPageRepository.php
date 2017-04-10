<?php

namespace App\Repositories;

use App\LinkiniPage;
use App\PageCategory;
use App\Advertisement;

use URL;
use File;

class LinkiniPageRepository extends ResourceRepository
{

    protected $linkiniPage;
    protected $pageCategory;
    protected $advertisement;

    public function __construct(LinkiniPage $linkiniPage, PageCategory $pageCategory, Advertisement $advertisement)
	{
		$this->model = $linkiniPage;
		$this->pageCategory = $pageCategory;
		$this->advertisement = $advertisement;
	}

	public function get()
	{
		return $this->model->get();
	}

	public function getAdvertisements()
	{
		return $this->advertisement->get();
	}

	public function storeAdmin(Array $inputs)
	{
		$imgName = $this->moveImage($inputs['image'], config('imageLinkiniPage.path'));

		if($imgName != '')
		{
			$inputs['image'] = $imgName;
			return $this->advertisement->create($inputs);
		}
		
	}

	public function getCategory($category)
	{
		return $this->pageCategory->where('name', $category)->first();
	}

	public function getHeader($entreprise_id)
	{
		$category = $this->getCategory('page_header');

		return $this->model->where('entreprise_id', $entreprise_id)->where('page_category_id', $category->id)->get();
	}

	public function getAbout($entreprise_id)
	{
		$category = $this->getCategory('page_about');

		return $this->model->where('entreprise_id', $entreprise_id)->where('page_category_id', $category->id)->get();
	}

	public function getServices($entreprise_id)
	{
		$category = $this->getCategory('page_services');

		return $this->model->where('entreprise_id', $entreprise_id)->where('page_category_id', $category->id)->get();
	}

	public function getContact($entreprise_id)
	{
		$category = $this->getCategory('page_Contact');

		return $this->model->where('entreprise_id', $entreprise_id)->where('page_category_id', $category->id)->get();
	}

	public function deleteCarouselImage($id)
	{
		$image = $this->advertisement->findOrFail($id);

		if($image)
		{
			File::delete("uploads/homepage/" . $image->image);
			$image->delete();
		}

	}
}