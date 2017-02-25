<?php

namespace App\Repositories;

use App\EntrepriseOrder;

class EntrepriseOrderRepository extends ResourceRepository
{

    protected $entrepriseOrder;

    public function __construct(EntrepriseOrder $entrepriseOrder)
	{
		$this->model = $entrepriseOrder;
	}
}