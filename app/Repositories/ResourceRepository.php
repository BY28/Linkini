<?php

namespace App\Repositories;

use App\User;

class ResourceRepository
{

    protected $model;

    public function getPaginate($n)
	{
		return $this->model->paginate($n);
	}

	public function store(Array $inputs)
	{
		return $this->model->create($inputs);
	}

	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}

	public function update($id, Array $inputs)
	{
		$this->getById($id)->update($inputs);
	}

	public function destroy($id)
	{
		$this->getById($id)->delete();
	}

	public function moveImage($image, $path)
	{
		if($image->isValid())
		{
			$name = '';

			$extension = $image->getClientOriginalExtension();

			do {
				$name = str_random(10) . '.' . $extension;
			} while(file_exists($path . '/' . $name));

			if($image->move($path, $name)) 
			{
				return $name;
			}
			else
			{
				return '';
			}
		}
	}

}