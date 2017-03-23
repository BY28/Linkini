<?php

namespace App\Repositories;

use App\Favorite;

class FavoriteRepository extends ResourceRepository
{

    protected $favorite;

    public function __construct(Favorite $favorite)
	{
		$this->model = $favorite;
	}

	public function favorites($user)
	{
		return $this->model->with('entreprise')->where('user_id', $user->id)
		->orderBy('created_at', 'desc')->get();
	}

	public function add($inputs)
	{
		$user = $inputs['user'];
		$entreprise_id = $inputs['entrepriseId'];

		$data = [
			'user_id' => $user->id,
			'entreprise_id' => $entreprise_id
		];

		$favorite = $this->model->where('entreprise_id', $entreprise_id)->where('user_id', $user->id)->first();

		if(!$favorite)
		{
			$this->store($data);
		}
		else
		{
			$this->model->destroy($favorite->id);
		}

	}
}