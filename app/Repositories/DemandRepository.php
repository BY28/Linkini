<?php

namespace App\Repositories;

use App\Demand;

class DemandRepository extends ResourceRepository
{

    protected $demand;

    public function __construct(Demand $demand)
	{
		$this->model = $demand;
	}

	private function queryWithUserAndTags()
	{
		return $this->model->with('user', 'tags')
		->orderBy('demands.created_at', 'desc');		
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
		$demand = $this->model->findOrFail($id);
		$demand->tags()->detach();
		$demand->delete();
	}
	/*
		*
		* PAS DE SURCHARGE POUR LE MOMENT
		*
	public function store(Array $inputs)
	{
		$imgName = $this->moveImage($inputs['image'], config('imageDemand.path'));

		if($imgName != '')
		{
			$inputs['image'] = $imgName;
			return $this->model->create($inputs);
		}
		
	}
	*/
}