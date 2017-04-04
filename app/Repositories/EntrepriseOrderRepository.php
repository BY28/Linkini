<?php

namespace App\Repositories;

use App\EntrepriseOrder;
use App\Entreprise;

use Illuminate\Support\Str;

class EntrepriseOrderRepository extends ResourceRepository
{

    protected $entrepriseOrder;
    protected $entreprise;
    protected $activity;

    public function __construct(EntrepriseOrder $entrepriseOrder, Entreprise $entreprise)
	{
		$this->model = $entrepriseOrder;
		$this->entreprise = $entreprise;
	}

	public function getPendingEntreprises()
	{
		return $this->model->where('accepted', 0)->where('refused', 0)->orderBy('created_at', 'desc')->get();		
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
			'email' => $entrepriseOrder->email,
			'phone' => $entrepriseOrder->phone,
			'address' => $entrepriseOrder->address,
			'description' => $entrepriseOrder->description,
            'entreprise_url' => Str::slug($entrepriseOrder->name),
			'user_id' => $entrepriseOrder->user_id,
			'activity_id' => $entrepriseOrder->activity_id,
			'category_id' => $entrepriseOrder->category_id
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

	public function refuse($inputs)
	{
		$entrepriseorder = $this->getById($inputs['entrepriseId']);
		$this->destroy($entrepriseOrder->id);
	}

	public function check($inputs)
	{
		$entreprise = $this->entreprise->findOrFail($inputs['entrepriseId']);

		$entreprise->checked = true;

		$entreprise->save();
	}

	public function getByUserId($user_id)
	{
		return $this->model->where('user_id', $user_id)->first();
	}

}