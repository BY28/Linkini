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
}