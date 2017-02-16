<?php

namespace App\Repositories;

use App\User;

class ProfileRepository extends ResourceRepository
{

    protected $user;

    public function __construct(User $user)
	{
		$this->model = $user;
	} 

}