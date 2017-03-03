<?php

namespace App\Repositories;

use App\EntrepriseOrder;
use App\Entreprise;

class EntrepriseOrderRepository extends ResourceRepository
{

    protected $entrepriseOrder;
    protected $entreprise;

    public function __construct(EntrepriseOrder $entrepriseOrder, Entreprise $entreprise)
	{
		$this->model = $entrepriseOrder;
		$this->entreprise = $entreprise;
	}

	public function getPendingEntreprises()
	{
		return $this->model->where('accepted', 0)->orderBy('created_at', 'desc')->get();		
	}

	public function getAcceptedEntreprises()
	{
		return $this->entreprise->where('checked', 0)
		->orderBy('created_at', 'desc')->get();		
	}

	public function getCheckedEntreprises()
	{
		return $this->entreprise->where('checked', 1)->orderBy('created_at', 'desc')->get();
	}

	public function accept($inputs)
	{
		$entrepriseOrder = $this->getById($inputs['entrepriseId']);

		$entrepriseOrder->accepted = true;

		$entrepriseOrder->save();

		$entrepriseInputs = [
			'name' => $entrepriseOrder->name,
			'user_id' => $entrepriseOrder->user_id
		];

		if($entrepriseOrder->accepted)
		{
			$this->entreprise->create($entrepriseInputs);
		}

		/*
		 * Supprimer la ligne des commandes.
		if($this->entreprise->create($entrepriseInputs))
		{
			$this->model->destroy($entrepriseOrder->id);
		}
		*/
	}

	public function check($inputs)
	{
		$entreprise = $this->entreprise->findOrFail($inputs['entrepriseId']);

		$entreprise->checked = true;

		$entreprise->save();
	}

}