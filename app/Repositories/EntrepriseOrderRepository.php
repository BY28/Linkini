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

	public function getPendingEntreprises()
	{
		return $this->model->where('accepted', 0)
		->orderBy('entreprise_orders.created_at', 'desc')->get();		
	}

	public function getAcceptedEntreprises()
	{
		return $this->model->where('accepted', 1)
		->orderBy('entreprise_orders.created_at', 'desc')->get();		
	}

	public function accept($inputs)
	{
		$entrepriseOrder = $this->getById($inputs['entrepriseId']);

		$entrepriseOrder->accepted = true;

		$entrepriseOrder->save();
	}
}