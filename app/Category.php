<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    	'name', 'category_url'
   	];

   	public function activities()
   	{
   		return $this->hasMany('App\Activity');
   	}

   	public function entreprises()
   	{
   		return $this->hasMany('App\Entreprise');
   	}

   	public function projects()
   	{
   		return $this->hasMany('App\Project');
   	}
}
