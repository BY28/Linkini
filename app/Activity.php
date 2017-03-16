<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
 	protected $fillable = [
 		'name', 'activity_url','category_id'
 	];

 	public function category()
 	{
 		return $this->belongsTo('App\Category');
 	}

 	public function entreprises()
 	{
 		return $this->hasMany('App\Entreprise');
 	}
}
